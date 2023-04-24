## Documentation of Project

I have created this project basically using html,css and jquery for frontend and php Laravel for the
backend process. I have used the amezia template for the backend and also some packages like yajra
datatable, sweetalert, etc.

## http://127.0.0.1:8000/user
In this route, we can view all the user. I have used yajra datatable through ajax and also integrated
pagination while viewing the list. The filter is also done through on the datatable through ajax as a result
the user list will be shown without page reload.

## http://127.0.0.1:8000/user-data
This route is for bring all the event in the datatable through ajax and to show them on the index page.

## http://127.0.0.1:8000/user/create
In this route, we can create user.

## http://127.0.0.1:8000/user/2/edit
In this route, we can edit the user. 

## http://127.0.0.1:8000/user/2/destroy
This route deletes the user through ajax. First it will ask for confirmation through sweet alert.


## http://127.0.0.1:8000/state
In this route, we can create, listout, update and delete state.


## http://127.0.0.1:8000/district
In this route, we can create, listout, update and delete district. It is linked with states table.

## http://127.0.0.1:8000/car
In this route, we can create, listout, update and delete car.

## http://127.0.0.1:8000/carmodel
In this route, we can create, listout, update and delete carmodel. It is linked with cars table

## http://127.0.0.1:8000/recieve-car
In this route, we can create, listout, update and delete recieve car. It is linked with user, carmodel and district table

## Unit Test
I have created some test for event. I think its not exactly what you wanted. I haven’t done unit test
previously.
