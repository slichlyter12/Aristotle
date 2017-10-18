# CS561-Project Software Engineering
### 2017/10/17:
Test Link:

* [Login page (index page)](http://web.engr.oregonstate.edu/~bij/pages)

* [TAClass page](http://web.engr.oregonstate.edu/~bij/pages/taClass.html)

* [StuedentQuestion page](http://web.engr.oregonstate.edu/~bij/pages/studentsQuestions.html)

>What works:
>* Login through ONID and automatically sign-up as student
>* StuedentQuestion page can use your username to post questions

>Problem:
>* You should change your user role from 0 to 1 in database to get the permission for TAClass page

### 2017/10/16:
Test Link:

* [Question list page for students](http://people.oregonstate.edu/~bij/CS561/studentsQuestions.html)

>What works:
>* Show all questions
>* Add a new question
>    * The empty inputs are not accepted
>    * Able to choose preferred time to come into the office hour
>    * The user status will be checked when adding new question (the user must exists and must be student)

* [Class management page for TA](http://people.oregonstate.edu/~bij/CS561/taClass.html)

>What works:
>* Show all classes
>    * Also show the classes which are selected by the current user
>    * The user status will be checked when presenting all the classes (the user must exists and must be TA)
>* Add a new class
>    * The empty inputs are not accepted
>    * Able to join the course once it has been created
>    * The user status will be checked when adding new class (the user must exists and must be TA)
