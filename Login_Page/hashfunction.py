from flask import Flask, request
import hashlib

app = Flask(__name__)

@app.route('/hash_password', methods=['POST'])
def hash_password():
    # Get the password from the form data
    input_password = request.form['password']
    
    # Get the user's IP address
    user_ip = request.remote_addr
    
    # Concatenate the IP address with the password
    password_with_ip = input_password + user_ip
    
    # Hash the concatenated string using SHA-256
    result = hashlib.sha256(password_with_ip.encode())
    
    # Print the resulting hash
    return result.hexdigest()

if __name__ == '__main__':
    app.run(debug=True)
