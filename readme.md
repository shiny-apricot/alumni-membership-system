<!-- instructions for running app -->

NOTE: IF "ENV" DIRECTORY ALREADY EXISTS IN THE APP'S DIRECTORY, SKIP STEPS 1 & 3

assuming you already have python3.3 or higher installed

1.)
from the app directory, run "python -m venv env" in the terminal to use environment directory in the app's directory. If it doesn't exist, it will be created

2.)
then, run "source env/Scripts/activate" or "env/Scripts/activate" (whichever one does not give an error) in the terminal to activate the virtual environment. An indicator should be in the terminal that you are currently in the virtual environment (to exit the virtual environment, run "deactivate". You can also run "source env/Scripts/activate" or "env/Scripts/activate" at any time to activate the virtual environment again)

3.)
lastly, run "pip install -r requirements.txt" while in the virtual environment to install packages from the requirements.txt file to the virtual environment

(optional) run "pip list" while in the virtual environment to see the list of the packages installed if necessary

4.) (running the app with a database)
to connect to a mysql database, open the 'db.yaml' and change the variables as instructed in the file

5.)
 the packages should all be set up. So, while in the virtual environment, run "python app.py" in the terminal. In the terminal, you should see a localhost link "http://127.0.0.1:5000/". Ctrl+click the link to open it in a browser or manually input the link in the browser to do the same thing

the app should be up and running on a local server

to stop running, simply ctrl+c in the terminal to close. Run "python app.py" at any time to re-run the app
