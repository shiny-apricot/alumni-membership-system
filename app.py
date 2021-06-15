
from flask import Flask, render_template, url_for, request, redirect, session, g
import psycopg2
import yaml
import logging
import os, hashlib
import member_list_reader as m_read
import receipt_reader as r_read
import login_page


app = Flask(__name__)
app.secret_key = os.urandom(24)

UPLOAD_FOLDER = 'upload'
# ALLOWED_EXTENSIONS = set(['xlsx', 'xls'])
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER



# postgresql database configuration
info = yaml.load(open('db.yaml'))
host = info['host']
user = info['user']
password = info['password']
database = info['db']
POSTGRESQL_URI = f'postgresql://{user}:{password}@{host}/{database}'

connection = psycopg2.connect(POSTGRESQL_URI)

@app.route('/')
def index():
  return render_template('login.html')

@app.route('/login', methods=['GET', 'POST',])
def login():
  if request.method == 'POST':
    session.pop('user', None)
    affirmative = login_page.login_function(request, connection)
    if affirmative:
      session['user'] = request.form['username']
      return redirect(url_for('home'))
  return render_template('login.html')

@app.route('/logout')
def logout():
  session.pop('user', None)
  render_template('login.html')


@app.route('/home')
def home():
  if g.user:
      with connection:
        with connection.cursor() as cursor:
          dep_list = list()
          app.logger.error("BELOW")
          print(dep_list)
          return render_template('home.html', user=session['user'], dep_list=dep_list)
  return redirect(url_for('login'))

@app.before_request
def before_request():
  g.user = None
  if 'user' in session:
    g.user = session['user']



@app.route('/bank')
def bank():
  if g.user:
    with connection:
      with connection.cursor() as cursor:
        query = "SELECT * FROM receipt ORDER BY date_of_receipt"
        cursor.execute(query)
        receipt_list = cursor.fetchall()
        print('receipt list= ',receipt_list)
        return render_template('bank.html', receipt_list=receipt_list, user=session['user'])
  return redirect(url_for('login'))



@app.route('/admins', methods=['GET', 'POST',])
def admins():
  if g.user:
    with connection:
      with connection.cursor() as cursor:
        if request.method == 'POST':
          print('POST!')
          if request.form.get('delete-admin'):
            admin_username = request.form['delete-admin']
            print('deleted admin username=> ',admin_username)
            if admin_username != 'admin':
              query = "DELETE FROM admin WHERE username = '"+admin_username+"' "
              cursor.execute(query)
              connection.commit()
          
          if request.form.get('add-admin'):
            print('add admin')
            admin_username = request.form['username']
            admin_password = request.form['password']
            print('username=> ', admin_username, 'password=>', admin_password)
            admin_password = admin_password.encode()
            admin_password = hashlib.md5(admin_password)
            admin_password = admin_password.hexdigest()

            query = "INSERT INTO admin(username, password) VALUES (' "+ admin_username +" ', ' "+ admin_password +" ')"
            cursor.execute(query)
            connection.commit()
            print('done')
          
          if request.form.get('update-password'):
            print('update admin password')


        query = "SELECT * FROM admin"
        cursor.execute(query)
        admins = cursor.fetchall()
        print('admins=> ',admins)
        return render_template('admins.html', admins=admins, user=session['user'])
  return redirect(url_for('login'))




@app.route('/table')
def table():
  if g.user:
    # postgre queries
    with connection:
      with connection.cursor() as cursor:
        cursor.execute("SELECT * FROM Member")
        members = cursor.fetchall()
    return render_template('table.html', members=members, user=session['user'])
  return redirect(url_for('login'))


@app.route('/profile/id=<member_id>', methods=['GET', 'POST'])
def profile(member_id):
  if g.user:
    with connection:
      with connection.cursor() as cursor:
        query = "SELECT * FROM Member WHERE member_id = "+member_id
        cursor.execute(query)
        member = cursor.fetchall()

        print('## member=',member)
        return render_template('profile.html', member=member, user=session['user'], member_id=member_id)
  return redirect(url_for('login'))

@app.route('/profile-edit/id=<member_id>', methods=['GET','POST'])
def edit_profile(member_id):
  if g.user:
    with connection:
      with connection.cursor() as cursor:
        query = "SELECT * FROM Member WHERE member_id = "+member_id
        cursor.execute(query)
        member = cursor.fetchall()

        print('## member=',member)
        return render_template('profile_edit.html', member=member, user=session['user'], member_id=member_id)
  return redirect(url_for('login'))


@app.route('/settings', methods=['GET', 'POST'])
def settings():
  if g.user:
    if request.method == 'POST':
      discount = request.form['"name" or "id" of content ']
    else:
      return render_template('settings.html',user=session['user'])
  return redirect(url_for('login'))



@app.route('/upload', methods=['GET', 'POST'])
def upload():
  if g.user:
    print('###############################')
    if request.method == "POST":

      print('first if')
      if request.files.get('receipt_file'):
        receipt_file = request.files["receipt_file"]
        print('got receipt')
        receipt_directory = save_file(receipt_file)
        dataframe = r_read.receipt_reader(receipt_directory)
        insert_receipt(connection,dataframe)
        return redirect(request.url)

      print('go next if')
      if request.files.get('member_file'):
        member_file = request.files['member_file']
        print('we got the FILES ##')
        member_directory = save_file(member_file)
        m_read.process_excel_rows(connection, member_directory)
        #redirect to upload page
        return redirect(request.url)
        
    return render_template('upload.html', user=session['user'])
  return redirect(url_for('login'))

def save_file(file):
      print('save file started')
      filename = file.filename
      work_directory = os.getcwd()
      # DEBUG
      print('work = > ', work_directory)
      print(os.path.join(work_directory, app.config['UPLOAD_FOLDER'], filename))
      print('filename',filename)
      print('special=> ', os.getcwd())
      # save the file
      file.save(os.path.join(work_directory, app.config['UPLOAD_FOLDER'], filename))
      # fetch_excel
      excel_directory = os.path.join(app.config['UPLOAD_FOLDER'], filename)
      return excel_directory

def insert_receipt(connection, dataframe):
    with connection:
      with connection.cursor() as cursor:
        for index, row in dataframe.iterrows():
          explanation = dataframe.at[index,'aciklama']
          dekont_no = dataframe.at[index,'dekont']
          tc_no = dataframe.at[index,'tc']
          # balance = dataframe.at[index,'balance']
          fee = dataframe.at[index,'fee']
          date = dataframe.at[index,'dekont']

          # balance = str(balance)
          fee = str(fee)

          query = "INSERT INTO receipt (receipt_no, Date_of_Receipt, National_ID_Number, Fee, explanation)"+" VALUES ('"+dekont_no+"', '"+date+"', '"+tc_no+"',"+fee+",'"+explanation+"');"
          cursor.execute(query)
          connection.commit()

def insert_members(connection, dataframe):
    with connection:
      with connection.cursor() as cursor:
        for index, row in dataframe.iterrows():
          year = dataframe.at[index,'year']
          borc = dataframe.at[index,'borc']
          kalan = dataframe.at[index,'kalan']


          # balance = str(balance)
          fee = str(fee)

          query = "INSERT INTO receipt (receipt_no, Date_of_Receipt, National_ID_Number, Fee, explanation)"+" VALUES ('"+dekont_no+"', '"+date+"', '"+tc_no+"',"+fee+",'"+explanation+"');"
          cursor.execute(query)
          connection.commit()



if __name__ == '__main__':
  app.run(debug=True)