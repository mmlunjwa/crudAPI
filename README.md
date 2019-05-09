#Prerequisites
What things you need to install the software.

- Git.
- PHP.
- Composer.
- Laravel CLI.

The RadioController handles all the endpoints: 
The models handle all interactions with the database


#Setup

$ cp .env.example .env 
Add the correct Database details
Update database detail in the following places:
phinx.yml
.env
bootstrap/app.php

#Routes
Maps endpoint to controller


#Migrate the application
$ vendor/bin/phinx migrate
3 database scripts located in db/scripts.sql tables have to be run manual there was an error I couldn't resolve 

#Run the application
cd into app directory and run:
$ php -S localhost:9000 -t public


#Endpoint Instruction

#addModel
Can create Presenter, Show and Slot
Using Postman, make a POST request to this endpoint http://localhost:9000/api/create endpoint. 
Navigate to the Body section on the tab and pass the following as parameters:
   
    //Presenters
        name:Eusebius McKaiser
        model: Presenters
        
   
    //Stations
        name:KFM
        model: Stations        
        
    //Shows
        name:Late Night Talk
        model: Slots
        slot_id: 1 
        
    //Slots
        show_id: 1  
        time_in: 6:00
        time_out: 9:00
        day_of_week: Monday  
        station_id:1 
        
#updateModel
Can update Presenter, Show and Slot
Using Postman, make a POST request to this endpoint http://localhost:9000/api/update endpoint. 
Navigate to the Body section on the tab and pass the following as parameters:
   
    //Presenters
        name:Eusebius McKaiser
        id: 1
        model: Presenters
        
    //Shows
        name:Late Night Talk
        id: 1
        model: Slots
        slot_id: 1 
              
    //Slots
        show_id: 1 
        id: 1
        presenter_id: 1 
        time_in: 6:00
        time_out: 9:00
        day_of_week: Monday      
        
        
#listModel
Can list Presenter, Show and Slot
Using Postman, make a GET request to this endpoint http://localhost:9000/api/list endpoint. 
Navigate to the Body section on the tab and pass the following as parameters:
   
    //Presenters
        model: Presenters
        filter_attribute: id
        filter_value=1
        
    //Show
        model: Slots
        filter_attribute: id
        filter_value=1
              
    //Slot
       model: Slots
       filter_attribute: day_of_week
       filter_value:Monday   
       
#deleteModel
Can delete Presenter, Show and Slot
Using Postman, make a POST request to this endpoint http://localhost:9000/api/delete endpoint. 
Navigate to the Body section on the tab and pass the following as parameters:
   
    //Presenters
        id: 1
        model: Presenters
        
    //Shows
        id: 1
        model: shows
              
    //Slot
       id: 1
        model: slots                     