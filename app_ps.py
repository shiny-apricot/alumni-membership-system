
from flask import Flask, render_template, url_for, request, redirect
import psycopg2
import yaml

app_ps = Flask(__name__)

# postgresql database configuration
info = yaml.load(open('db.yaml'))
host = info['host']
user = info['user']
password = info['password']
database = info['db']
POSTGRESQL_URI = f'postgresql://{user}:{password}@{host}/{database}'

connection = psycopg2.connect(POSTGRESQL_URI)

@app_ps.route('/')
def home():
  return render_template('home.html')

@app_ps.route('/home')
def index():
  return render_template('index.html')

@app_ps.route('/bank')
def bank():
  return render_template('bank.html')

@app_ps.route('/admins', methods=['GET', 'POST',])
def admins():
  return render_template('admins.html')

@app_ps.route('/table')
def table():
  # postgre queries
  with connection:
    with connection.cursor() as cursor:
      cursor.execute("SELECT * FROM Member")
      members = cursor.fetchall()
  return render_template('table.html', members=members)

@app_ps.route('/settings', methods=['GET', 'POST'])
def settings():
  if request.method == 'POST':
    discount = request.form['"name" or "id" of content ']
  else:
    return render_template('settings.html')


if __name__ == '__main__':
  app_ps.run(debug=True)