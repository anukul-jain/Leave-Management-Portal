# Leave-Management-Portal
This Project is contributed by: 
ANUKUL JAIN
PRADYUMNA PARSAI
SATYAM GUSAIN

In this project we worked on : 

  1. Frontend - HTML5, CSS & JavaScript
  2. Backend - PHP, XAMPP (phpmyadmin for MySQL), NoSQL(MongoDB)

## About The Project

In this project, the members are creating a leave management system. The project has
the following components:

  1. **FACULTY CONSOLE**
  2. **ADMIN MANAGEMENT CONSOLE**
  3. **FACULTY REGISTRATION COMPONENT**
  
Before accessing the **FACULTY CONSOLE**, the faculty has to register himself/herself using
the **FACULTY REGISTRATION COMPONENT**. The registration component consists of a
HTML form and the confirmation page for the same. 

**FACULTY CONSOLE**
  1. Faculty are divided into departments (e.g., CS, EE, ME, Civil, etc.). Each department has a
      head-of-department (HoD) who is also one of the faculty members in the department.
  2. Cross-cutting Faculty: Dean Faculty Affairs, Dean Academic Affairs, Dean Research and Dean
      Student Affairs.
  3. Leave applications: From time-to-time, faculty can go on a leave. Depending on the post of the         applicant, his/her leave application would go through a specific route. For instance, leave           application of a faculty follows the following route for approval: Faculty → HoD → Dean Faculty       Affairs. In each stage, the person forwards with comments. Finally Dean Faculty Affairs               approves or rejects. After approval, leave is deducted from the available
      leaves and an intimation is sent to faculty. Leave applications of HoDs and Deans are approved       directly by the Director. Two more things to
      note here: 
      (a) Each employee has a fixed number of leaves per year (and they expire at the end of             the year). 
      (b)Sometimes, HoD, concerned head, and/or Dean FAA may redirect the application to the employee         for more comments. Once approved (or rejected), the concerned faculty is intimated. Also note         that the concerned faculty should be able to see the current position of the leave                    application and all the comments made on it by different entities. These comments can also            be seen by HoD and Dean Faculty Affairs.
      Following Depts in Faculty: CSE, ME and EE. Each Dept has an HoD. HoD is a current faculty of         the dept.
      Following Deans: Dean Faculty Affairs (any of the current faculty can become Dean for a certain        duration).
      One Director: And everybody comes under the Director. Director is also a faculty in any one of        the departments.
      ● Basic Employee Portals: Each of the employees would have their own personal portals. Portals        should have the following:
      (a) Personal Information, 
      (b)Total number leaves available this year, 
      (c) Status of the leave applications (including the comments added by various entities,
      (d) Options to start new leave applications, 
      (e) Respond to comments made on leave applications.
      ● Specialized Portals: Each of the named positions such as HoD, Dean and Director would have         specialized portals
        for handling the applications. Note that all the specialized portal logins must be tied up          with an employee (implicity). For e.g., consider a faculty named Dr Rajesh in the CSE dept.           When he becomes the HoD of the CSE dept, his login should now have options to                         approve/reject/make comments on the leave applications of the CSE
        dept faculty. And his own leave applications would now go to the Director. These features             should be removed
        when he steps down from the HoD position.

 
  
The **ADMIN MANAGEMENT** CONSOLE consists of the following features:

  1. Removal of an employee (if he/she has quit the company)
  2. Changing designation of a faculty of a particular department.

