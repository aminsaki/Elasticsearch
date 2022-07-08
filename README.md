 # installl elasticsearch in laravel
 elasticsearch/elasticsearch": "^8.3", 
 
 
 
 # install elasticsearch  into ubunut  
 
 sudo apt install elasticsearch
  
 # run  elasticsearch
 $ sudo systemctl daemon-reload
 
 #Then, enable the Elasticsearch service with:
 sudo systemctl enable elasticsearch.service   
 #And finally, after the service is enabled, start Elasticsearch:
 sudo systemctl start elasticsearch.service 
 


#Note: If you're on Windows Ubuntu, the systemctl commands won't work. Instead, use the following commands to start, stop and restart the #Elasticsearch service:
 
 sudo service elasticsearch start
sudo service elasticsearch stop
sudo service elasticsearch restart
 #Allow Remote Access 
 
 sudo vim /etc/elasticsearch/elasticsearch.yml 
 
 
# Scroll down to the Network section. Find the line that says #network.host.

#Uncomment the line (remove the pound (#) sign), set the IP address to 0.0.0.0, and add these lines:




transport.host: localhost

transport.tcp.port: 9300

http.port: 9200



# status 

sudo ufw allow 22 
sudo ufw enable
sudo ufw status 



#Test Elasticsearch 
curl localhost:9200





