
from flask import Flask, render_template, url_for, request, redirect
from flask_mysqldb import MySQL
import yaml

app = Flask(__name__)

# mysql database configuration
db = yaml.load(open('db_mysql.yaml'))
app.config['MYSQL_HOST'] = db['host']
app.config['MYSQL_USER'] = db['user']
app.config['MYSQL_PASSWORD'] = db['password']
app.config['MYSQL_DB'] = db['db']

mysql = MySQL(app)


@app.route('/')
def home():
  return render_template('home.html')

# @app.route('/home')
# def index():
#   return render_template('index.html')

@app.route('/bank')
def bank():
  return render_template('bank.html')

@app.route('/admins', methods=['GET', 'POST',])
def admins():
  return render_template('admins.html')

@app.route('/table')
def table():
  # mysql queries
  cur = mysql.connection.cursor()
  result = cur.execute("SELECT * FROM Member")
  if result > 0:
    members = cur.fetchall()
  cur.close()
  return render_template('table.html', members=members)

@app.route('/settings', methods=['GET', 'POST'])
def settings():
  if request.method == 'POST':
    discount = request.form['"name" or "id" of content ']
  else:
    return render_template('settings.html')


if __name__ == '__main__':
  app.run(debug=True)