from flask import request, jsonify #ambil library json untuk konversi Datatable kebebntuk data json
from app import app #ambil folder app dan semua isinya
from app.constant import RequestMethod #ambil folder app -> constant dan ambil file RequestMethod
from app.model.QueriesModel import Queries #ambil folder app -> model -> QueriesModel dan ambil file Queries
from app.model.DetailsModel import Details #ambil folder app -> model -> DetailsModel dan ambil Details Queries
from app.module.Engine import preprocess, Engine #ambil folder app -> Engine dan ambil Calss Engine dan fungsi preprocess
import pandas as pd #ambil library pandas
import os #ambil library os
from numpy import math #ambil library numpy untuk konversi hasil score NAN


@app.route("/", methods=RequestMethod.GET)
def index():
    return jsonify({"message": "ok"})


@app.route("/search", methods=RequestMethod.GET_POST)
def search():
    dataset = pd.read_excel("app/db/databerita.xlsx")
    response = list()  # Define response
    if request.method == "POST":
        if "files" in request.files:
            file = request.files["files"]
            file.save(os.path.join("app/tmp", "queries.xlsx"))
            queries = pd.read_excel("app/tmp/queries.xlsx")
            queries = queries["Queries"].values
        else:
            resp = {
                "error": "invalid request",
                "path": "/search",
                "message": "request should be file"
            }
            resp = jsonify(resp)
            resp.status_code = 400
            print(resp)
            return resp

    elif request.method == "GET":
        if 'q' in request.args:
            queries = [request.args['q']]
        else:
            resp = {
                "error": "invalid request",
                "path": "/search",
                "message": "request should be query"
            }
            resp = jsonify(resp)
            resp.status_code = 400
            return resp

        # Preproces queries
    queriesPre = list()
    for query in queries:
        queriesPre.append(preprocess(query))

    # Cek di database apakah ada data dengan query pada inputan ataupun file
    for query in queriesPre:
        data = Queries.findByQueryName(query)
        if data is not None:
            response.append(data)

    if len(response) is not 0:
        return jsonify(response)
    else:
        engine = Engine()
        docs = [str(x) for x in dataset['preprocessed_judul']]
        documentsName = list()

        for i, doc in enumerate(docs):
            engine.addDocument(doc)
            documentsName.append("Document_{}".format(i + 1))

        for query in queriesPre:
            engine.setQuery(query)  # Set query pencarian

        titlesScores = engine.process_score()
        ScoreDf = (pd.DataFrame(titlesScores)).T
        ScoreDf.columns = queriesPre
        ScoreDf["Documents"] = documentsName
        dfListed = list()
        for i in queriesPre:
            labels = list()
            for j in ScoreDf[i]:
                if j > 0.000:
                    labels.append(1)
                else:
                    labels.append(0)
            datadf =pd.DataFrame(ScoreDf[i])
            datadf["Documents"] = ScoreDf["Documents"]
            datadf["Labels"] = labels
            datadf['Judul'] = dataset['judul berita'].values
            datadf['Media'] = dataset['media'].values
            datadf['Kategori'] = dataset['kategori'].values
            dfListed.append(datadf.sort_values(by=[i], ascending=False))
        for i, df in enumerate(dfListed):
            dbQuery = Queries(queriesPre[i])
            for j in range(len(df["Documents"])):
                if (math.isnan(float(df[queriesPre[i]][j]))):
                    score = '0'
                else:
                    score = float(df[queriesPre[i]][j])
                document = df["Documents"][j]
                label = int(df["Labels"][j])
                score = score
                judul = df["Judul"][j]
                media = df["Media"][j]
                kategori = df["Kategori"][j]
                data = document, label, score , judul, media, kategori
                details = Details(data)
                
                dbQuery.details.append(details)
            dbQuery.save()

        for query in queriesPre:
            data = Queries.findByQueryName(query)
            response.append(data)

        return jsonify(response)


@app.route("/test", methods=RequestMethod.GET)
def getData():
    response = Queries.getAll()
    print(response)
    return jsonify(response)
