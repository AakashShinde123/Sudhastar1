echo "BUILD START"
python3 -m pip install -r requirements.txt
python manage.py collectstatic --noinput
docker build -t mydjangoapp .
pip install paypalrestsdk

echo "BUILD END"
