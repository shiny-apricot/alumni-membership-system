from flask import Flask, render_template, url_for, request, redirect
import psycopg2
import yaml
import coloredlogs, logging
import os
import hashlib as hash

error = list()
loggedIn = False

def login_function(request, connection):
    username = request.form.get('username')
    password = request.form.get('password')

    username = str(username)
    password = str(password)
    print('username= ',username)
    print('password= ',password)

    if(username == ''):
        error.append('Username is required')
    if(password == ''):
        error.append('Password is required')

    password = password.encode()
    if len(error) == 0:
        password = hash.md5(password)
        password = password.hexdigest()
        print('final password=', password)
        query = "SELECT * FROM user_table WHERE username = '"+ username+"' AND password = '"+ password +"'"
        with connection:
            with connection.cursor() as cursor:
                cursor.execute(query)
                fetch = cursor.fetchall()
                print("login fetch=> ",fetch)
                if len(fetch) >= 1:
                    loggedIn = True
                    return True
    else:
        return False
                



