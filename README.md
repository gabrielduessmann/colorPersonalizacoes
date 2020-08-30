 # Objective

This was a project for my technician in computering.  It was made by me and more 3 students.
The main ideia was to develop a web site having simple CRUDs.

# What is the website for
The site is for the employees of a company rensponsible to customize itens (shirts, mugs, pens, etc) and manage all the customization process.

There are 3 types of users, I will resume the main functionalities about each one:

* **Attendant:** Register new clients and make the customization work order.

* **Customizer:** Responsible to make the customizations in the product. After the work order be approved, he/she can swit its status. The status are: **to do**, **doing** and **done**.

* **Manager:** Register new itens to be customized, approve or deny work orders and has access to reports.
 

 # How to run through XAMPP

### XAMPP

* Download XAMPP with MySql
* Open XAMPP and start Apache and MySql

### htdocs
* Go to XAMPP file and open ```htdocs```, then save the project in this file.

### Database configuration
* Open the URL: ```http://localhost/phpmyadmin/```
* Import the database. Find where you saved your file and then the path is  ```bd/bd_copulado/bd_colorpersonalizacoes.sql ```
* If not create the table automatically, create it manually and put the name as ```bd_colorpersonalizacoes``` 

### Database password


### Browser

* Open ```http://localhost/colorPersonalizacoes```
* Now it is all setted, just use the site :)

### Login

#### Attendant
* **User:** ```janderson```
* **Password:** ```12345678```

#### Customizer
* **User:** ```bruna```
* **Password:** ```12345678```

#### Manager
* **User:** ```adm```
* **Password:** ```12345678```

#### For MySql Database
* **User:** ```root```
* **Password:** ``` ``` (empty)


# Technologies used

* Back-end: PHP
* Front-end: JavaScript, HTML, AJAX and CSS
* Database: MySql

# Libraries

* PHP Session
* PHP Mailer
* mPDF
* Ajax GoogleAPIs 


# Project Structure
The structure of the project is divided in two parts. The first is the comercial one, that anyone (especially the clients) can have access to it, they can see about the company, see some products mades and have the company contact. For the employees there is the section login where they can login to the system.

PHP was splitted in two files:
* **websiteTabs:** PHP files for the part where it shows the products and all the clients have accss to use and see.

* **systemTabs:** It contais all the tabs and the back-end application.
PHP files that contain ```Form``` in your name are responsible for HTML and to get data from database. Other PHP files are just for back-end.
Ex: ```clientRegistrationForm.php``` it has all the HTML and also get all the clients registered in database.
```registerClient.php``` and ```deleteClient.php``` are just responsbible for PHP back-end.


# Observation
The site is not responsive, so please zoom in or out for a better layout and experience.


# Prints

Below, it has some prints of the most used funcionalities in the site.

![print1](/img/prints/mugs.png)

### Products made by the company
**Who has access:** Anyone
All the clients can have access to this tab and they can see which products the company customizes and get information about it.
Here anyone (especially clients or people who wants to see the products) sees the products of the company and can get intereseted.

Clients can access the website and meet the company and see its products

![print2](/img/prints/login.png)
### Login
**WHo has access:** Employee
 Anyone can have access, but only the employees with their **user** and **password** can login into the system.


![print3](/img/prints/registerClient.png)
### Client registration
**Who has access:** Attendant and Manager
Create a new user, who wants to make a product customization. It can be consulted all the clients already registered. Moreover, they can be edited or deleted.

![print4](/img/prints/budget.png)
### Budget
**Who has access:** Attendant and Manager
After the client knows what he/she wants to customize, it is made a budget for the client. There are options to filter in category, the client may have discounts or pay in parts.

![print5](/img/prints/workOrder.png)
### Work order
**Who has access:** Manager
After the budget be one, the manager decides if he/she approves or rejects it. If it be accepted it become a work order and go to some customizer start doing the cutomization.

![print6](/img/prints/workOrderStatus.png)
### Work order status
**Who has access:** Customizer
Thoughout the working hours, the customizer manages and swits the status of the work order. 

![print7](/img/prints/pdf.png)
### Budget PDF
**Who has access:** Manager
The manager can generate a PDF about the either budgets or work orders. It contais the most valueable informations.


# License
Feel free to use it and open pull requests.

[MIT](https://choosealicense.com/licenses/mit/)
