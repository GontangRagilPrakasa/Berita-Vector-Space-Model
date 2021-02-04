from app import db


class Details(db.Model):
    __tablename__ = "details"  # Define nama table

    id = db.Column(db.Integer, unique=True, primary_key=True, nullable=False)
    document = db.Column(db.String, nullable=False)
    label = db.Column(db.Integer, nullable=False)
    score = db.Column(db.Float, nullable=False)
    judul = db.Column(db.String, nullable=False)
    media = db.Column(db.String, nullable=False)
    kategori = db.Column(db.String, nullable=False)
    query_id = db.Column(db.Integer, db.ForeignKey("queries.id"))

    def __init__(self, data):
        document, label, score, judul, media, kategori = data
        self.document = document
        self.label = label
        self.score = score
        self.judul = judul
        self.media = media
        self.kategori = kategori
        

    def __repr__(self):
        return "<kategori: {}>".format(self.kategori)

    @staticmethod
    def getAll(queryId):
        details = Details.query.filter_by(query_id=queryId).order_by(Details.score.desc()).limit(5).all()
        result = list()
        for data in details:
            obj = {
                "id": data.id,
                "document": data.document,
                "label": data.label,
                "score": data.score,
                "media": data.media,
                "kategori": data.kategori,
                "judul": data.judul
            }
            result.append(obj)
        return result
