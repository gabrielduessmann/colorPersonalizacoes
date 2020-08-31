 # Objective

This was a project for my technician in computing.  It was made by me and more 3 students.
The main idea was to develop a website having simple CRUDs.

# What is the website for
The site is for the employees of a company responsible to customize items (shirts, mugs, pens, etc) and manage all the customization process.

There are 3 types of users, I will resume the main functionalities about each one:

* **Attendant:** Register new clients and make the customization budget.

* **Customizer:** Responsible to make the customizations in the product. After the work order be approved, he/she can swit its status. The status are: **To Do**, **Doing** and **Done**.

* **Manager:** Register new itens to be customized, approve or deny budgets (if approved become a work order) and has access to reports.
 

# How to run through XAMPP

### XAMPP
* Open XAMPP and start Apache and MySql

### htdocs
* Go to XAMPP file and open ```htdocs```, then save the repository in this file.

### Database configuration
* Open the URL: ```http://localhost/phpmyadmin/```
* Import the database. Find where you saved your file and then the path is  ```bd/bd_copulado/bd_colorpersonalizacoes.sql ```
* If not create the database automatically, create it manually with the name ```bd_colorpersonalizacoes```

#### MySQL password
* If you have problems with MySQL password, change your MySQL password to:
* **User:** ```root```
* **Password:** ``` ``` (empty)


### Browser

* Open ```http://localhost/colorPersonalizacoes```
* Now it is all setted, just use the site :)

### Login

To access the system as employee, in the menu, click in **Login** and choose one of the users below to log in.

#### Attendant
* **User:** ```janderson```
* **Password:** ```12345678```

#### Customizer
* **User:** ```bruna```
* **Password:** ```12345678```

#### Manager
* **User:** ```adm```
* **Password:** ```12345678```


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
The structure of the site is divided in two parts. The first one is the comercial, that anyone (especially the clients) have access to it, they can see about the company and products customization made by it. 
For the employees, there is the section login where they can login to the system.

PHP was splitted in two folders:
* **websiteTabs:** PHP files for the part where it shows the products customization and all the clients have access see it.

* **systemTabs:** It contais all the pages and the back-end application of the system that only the employees have access.
PHP files that contain ```Form``` in your name are responsible for HTML and to get data from database. Other PHP files are just for back-end.

Ex: 
* ```clientRegistrationForm.php``` it contains all HTML and get all the clients registered from the database.
* ```registerClient.php``` and ```deleteClient.php``` are just responsible for PHP back-end application.


# Observation
The site is not responsive, so please zoom in or out for a better layout and experience.


# Prints

Below, it has some prints of the most used funcionalities in the site.


### Products made by the company
**Anyone** (especially the clients) have access to this page and they see the customized products made by the company and get information about it.

![print1](/img/prints/mugs.png)


### Login
**Anyone** can have access this page. However, only the **employees** who has a **user** can log into the system.

![print2](/img/prints/login.png)


### Client registration
**Attendants** and **managers** can create new clients. Only clients who are registered  can order a budget for a customization. In this page it shows all the clients already registered. Moreover, they can be edited or deleted.

![print3](/img/prints/registerClient.png)


### Budget
**Attendants** and **managers** can make budgets for the clients. Here it contains all the details about the product(s) that will be customized and the total price for the client. After the budget made, the **manager** has to approve or reject it. If rejected, it is deleted (logically in the database). If approved, it becomes a work order.

![print4](/img/prints/budget.png)


### Work order
**Managers** makes a work order when they approve a budget. Then the work order will go to the customizers, who will be responsible for all the customization. In this page, the **managers** can also consult for the work orders.

![print5](/img/prints/workOrder.png)


### Work order status
**Customizers**, throughout the customization process, manages and swits the status of the work order. 

![print6](/img/prints/workOrderStatus.png)
 

 ### Budget PDF
**Managers** can generate PDFs of budgets or work orders. It contains the most valuable informations for their analyze.

![print7](/img/prints/pdf.png)


# License
Feel free to use it and open pull requests to contribute to the repository.

[MIT](https://choosealicense.com/licenses/mit/)
