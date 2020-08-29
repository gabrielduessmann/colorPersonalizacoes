 # Objective

This was a project for my technician in computering.  It was made by me and more 3 students.
The main ideia was to develop a web site with a simple CRUD.

# What is the website for
The site is for the employees of a company rensponsible to customize itens (shirts, mugs, pens, etc) and manage all the customization process.

There are 3 types of users, I will resume the main functionalities about each one:

* **Attendant:** Register new clients and make the customization work order.

* **Customizer:** Responsible to make the customizations in the product. After the work order be approved, he/she can swit its status. The status are: **to do**, **doing** and **done**.

* **Manager:** Register new itens to be customized, approve or deny work orders and has access to reports.
 

# Technologies used

* Back-end: PHP
* Front-end: JavaScript, HTML, AJAX and CSS
* Database: MySql

# Libraries

* PHP Session
* PHP Mailer
* mPDF
* Ajax GoogleAPIs 

# Observation
The site is not responsive, so please zoom in or out for a better layout and experience.

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


# Prints

![print1](/img/prints/mugs.png)
**Access:** Anyone

![print2](/img/prints/login.png)
**Access:** Anyone

![print3](/img/prints/registerClient.png)
**Access:** Attendant and Manager

![print4](/img/prints/budget.png)
**Access:** Attendant and Manager

![print5](/img/prints/workOrder.png)
**Access:** Manager

![print6](/img/prints/workOrderStatus.png)
**Access:** Customizer

![print7](/img/prints/pdf.png)
**Access:** Manager


# License
Feel free to use it and open pull requests.

[MIT](https://choosealicense.com/licenses/mit/)
