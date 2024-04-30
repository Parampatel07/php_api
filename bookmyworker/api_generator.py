import os

def create_files(file_data):
    for data in file_data:
        file_name = data['file_name']
        file_content = data['content']

        # Create the file and write the content
        with open(file_name, 'w') as file:
            file.write(file_content)

        print(f"File '{file_name}' created successfully.")

# Example usage
file_data_list = [
    {'file_name' :' insert_admin.php' , 'content' :''},
    {'file_name' : 'update_admin.php' , 'content':''},
    {'file_name' : 'delete_admin.php' , 'content':''},
    {'file_name' : 'get_admin.php' , 'content':''},
    {'file_name' : 'insert_booking.php' , 'content':''},
    {'file_name' : 'get_booking.php' , 'content':''},
    {'file_name' : 'update_booking.php' , 'content':''},
    {'file_name' : 'delete_booking.php' , 'content':''},
    {'file_name' : 'insert_service.php' , 'content':''},
    {'file_name' : 'update_service.php' , 'content':''},
    {'file_name' : 'get_service.php' , 'content':''},
    {'file_name' : 'delete_service.php' , 'content':''},
    {'file_name' : 'insert_user.php' , 'content':''},
    {'file_name' : 'delete_user.php' , 'content':''},
    {'file_name' : 'get_user.php' , 'content':''},
    {'file_name' : 'update_user.php' , 'content':''},
    {'file_name' : 'insert_worker.php' , 'content':''},
    {'file_name' : 'delete_worker.php' , 'content':''},
    {'file_name' : 'update_worker.php' , 'content':''},
    {'file_name' : 'get_worker.php' , 'content':''},
    {'file_name' : 'insert_worker_service.php' , 'content':''},
    {'file_name' : 'get_worker_service.php' , 'content':''},
    {'file_name' : 'update_worker_service.php' , 'content':''},
    {'file_name' : 'delete_worker_service.php' , 'content':''},
]
create_files(file_data_list)