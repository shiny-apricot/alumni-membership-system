
from flask import Flask, render_template, url_for, request, redirect
import psycopg2
import yaml
import coloredlogs, logging
import os
import fetch_excel 

app = Flask(__name__)

coloredlogs.install(level='DEBUG')

# postgresql database configuration
info = yaml.load(open('db.yaml'))
host = info['host']
user = info['user']
password = info['password']
database = info['db']
POSTGRESQL_URI = f'postgresql://{user}:{password}@{host}/{database}'

connection = psycopg2.connect(POSTGRESQL_URI)

@app.route('/')
def home():
  return render_template('home.html')


@app.route('/home')
def index():
  with connection:
        with connection.cursor() as cursor:
          cursor.execute("SELECT d.department_name d_name, count(*) as number FROM Member m "
                              "INNER JOIN Department d ON m.department = d.department_code GROUP BY d_name")
          department = cursor.fetchall()
          dep_list = list()
          for dep in department: 
            # '["'+ dep[0] + '",' + str(dep[1]) +'],'
            dep_list.append(dep)
          app.logger.error("BELOW")
          print(dep_list)
  return render_template('home.html', dep_list= dep_list)


@app.route('/bank')
def bank():
  return render_template('bank.html')


@app.route('/admins', methods=['GET', 'POST',])
def admins():
  return render_template('admins.html')


@app.route('/table')
def table():
  # postgre queries
  with connection:
    with connection.cursor() as cursor:
      cursor.execute("SELECT * FROM Member")
      members = cursor.fetchall()
  return render_template('table.html', members=members)


@app.route('/settings', methods=['GET', 'POST'])
def settings():
  if request.method == 'POST':
    discount = request.form['"name" or "id" of content ']
  else:
    return render_template('settings.html')


UPLOAD_FOLDER = 'upload\\'
# ALLOWED_EXTENSIONS = set(['xlsx', 'xls'])
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER


@app.route('/upload', methods=['GET', 'POST'])
def upload():
  if request.method == "POST":
    if request.files:
      # take the file 'existing'
      print('we got the FILE ##')
      existing_file = request.files["existing_file"]
      filename = existing_file.filename
      work_directory = os.getcwd()
      # print
      print('work = > ', work_directory)
      print(os.path.join(work_directory, app.config['UPLOAD_FOLDER'], filename))
      print('filename',filename)
      print('special=> ',os.getcwd())
      # save the file
      existing_file.save(os.path.join(work_directory, app.config['UPLOAD_FOLDER'], filename))
      # fetch_excel
      excel_directory = os.path.join(app.config['UPLOAD_FOLDER'], filename)
      fetch_excel.fetch_excel_rows(excel_directory)
      #redirect to upload page
      return redirect(request.url)
  return render_template('upload.html')


if __name__ == '__main__':
  app.run(debug=True)