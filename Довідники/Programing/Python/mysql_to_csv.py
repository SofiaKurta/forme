import csv
import re
 
import pymysql.cursors
 
# Connect to the database
connection = pymysql.connect(host='localhost',
                             user='tx',
                             password='12345678',
                             db='tx',
                             charset='utf8mb4',
                             port=3468,
                             cursorclass=pymysql.cursors.DictCursor)
 
 
def csv_writer(results, path='/home/YOUR_USERNAME/Documents/example.csv'):
    with open(path, 'w', newline='') as csvfile:
        fieldnames = ['#', 'datetime', 'from', 'to', 'phone', 'order_count', 'sign']
        writer = csv.DictWriter(csvfile, fieldnames=fieldnames)
        writer.writeheader()
        count = 1
        for order in results:
            writer.writerow(
                {
                    '#': count,
                    'datetime': order['datetime'],
                    'from': re.sub(r"(&quot;|quot;|quot|&amp;|amp;|amp|;)", r"", order['fr']),
                    'to': re.sub(r"(&quot;|quot;|quot|&amp;|amp;|amp|;)", r"", order['to']),
                    'phone': str("=\""+order['phone']+"\""),
                    'order_count': order['order_count'],
                    'sign': order['taxi_dep'],
                }
            )
            count += 1
 
 
try:
    with connection.cursor() as cursor:
        # Read a single record
        sql = "SELECT oc.`datetime`, oc.`from` as fr, oc.`to`, oc.phone, oc.order_count, td.name as taxi_dep, " \
              "d.sign as driver FROM `td_orders_completed` as oc " \
              "LEFT JOIN td_taxi_departments as td ON oc.department_id = td.id " \
              "LEFT JOIN td_drivers as d ON oc.driver_id = d.id ORDER BY oc.datetime ASC"
        cursor.execute(sql)
        result = cursor.fetchall()
 
        csv_writer(result)
finally:
    connection.close()
