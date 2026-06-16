from flask import Flask, request, jsonify
from groq import Groq

app = Flask(__name__)

client = Groq(
    api_key="API_KEY_GROQ_KAMU"
)

@app.route('/chat', methods=['POST'])
def chat():

    data = request.json
    user_message = data.get("message")

    completion = client.chat.completions.create(
        model="llama3-8b-8192",
        messages=[
            {
                "role": "system",
                "content": """
                Kamu adalah CaraniBot, asisten properti yang ramah, santai, dan profesional.
                Jawab dengan bahasa Indonesia natural.
                """
            },
            {
                "role": "user",
                "content": user_message
            }
        ]
    )

    reply = completion.choices[0].message.content

    return jsonify({
        "reply": reply
    })


if __name__ == "__main__":
    app.run(
        host="127.0.0.1",
        port=5000,
        debug=True
    )