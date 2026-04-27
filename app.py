from flask import Flask, request, jsonify
from flask_cors import CORS
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.naive_bayes import MultinomialNB
import numpy as np

app = Flask(__name__)
CORS(app) # Agar bisa diakses dari HTML berbeda domain/port

# 1. DATA LATIH (Training Data)
# Kita ajari bot dengan contoh kalimat dan labelnya
data_latih = [
    ("halo", "salam"),
    ("selamat pagi", "salam"),
    ("berapa harga rumah", "harga"),
    ("biaya cicilan mahal gak", "harga"),
    ("saya mau kredit rumah", "kpr"),
    ("proses KPR gimana", "kpr"),
    ("lokasi kantor dimana", "lokasi"),
    ("alamat properti di mana", "lokasi")
]

texts, labels = zip(*data_latih)

# 2. PROSES TRAINING (Mesin Belajar)
# Mengubah teks jadi angka (Vector)
vectorizer = TfidfVectorizer()
X = vectorizer.fit_transform(texts)
y = np.array(labels)

# Melatih model Naive Bayes
model = MultinomialNB()
model.fit(X, y)

# 3. API ENDPOINT (Tempat Browser Menghubungi)
@app.route('/chat', methods=['POST'])
def chat():
    user_input = request.json.get('message')
    
    # Ubah input user jadi vektor sesuai pola training
    user_vector = vectorizer.transform([user_input])
    
    # Prediksi intent
    prediksi = model.predict(user_vector)[0]
    confidence = max(model.predict_proba(user_vector)[0])
    
    # Logika Respon Berdasarkan Hasil Prediksi ML
    respon = ""
    if confidence < 0.5: # Jika model kurang yakin
        respon = "Maaf, saya kurang mengerti. Bisa diulang dengan bahasa lain?"
    elif prediksi == 'salam':
        respon = "Halo! Selamat datang di PropertiHarmoni. Ada yang bisa dibantu? 😊"
    elif prediksi == 'harga':
        respon = "Harga kami bervariasi mulai 500jt hingga 3M. Mau cari di range berapa?"
    elif prediksi == 'kpr':
        respon = "Untuk KPR, kami kerjasama dengan BCA, Mandiri, dan BNI. Mau simulasi cicilan?"
    elif prediksi == 'lokasi':
        respon = "Kantor kami ada di Jl. Raya Malang No. 10. Mau kirim Google Maps-nya?"
    else:
        respon = "Mohon maaf, tim kami akan segera membalas pertanyaan spesifik Anda."

    return jsonify({'response': respon, 'intent': prediksi})

if __name__ == '__main__':
    app.run(debug=True)