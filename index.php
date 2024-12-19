<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operation with jQuery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        #addForm {
            width: 90%;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
        }

        input, select, button {
            padding: 10px;
            margin: 5px;
            flex: 1 1 calc(30% - 10px);
            box-sizing: border-box;
        }

        button {
            flex: 1 1 100%;
        }
    </style>
</head>
<body>
    <h1 style="text-align:center;">CRUD Operation using jQuery</h1>
    <div id="addForm">
        <input type="text" id="name" placeholder="Enter Name">
        <input type="number" id="age" placeholder="Enter Age">
        <select id="gender">
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        <input type="text" id="mobile" placeholder="Enter Mobile Number">
        <input type="text" id="qualification" placeholder="Enter Qualification">
        <input type="text" id="address" placeholder="Enter Address">
        <button id="saveBtn">Save</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Mobile</th>
                <th>Qualification</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="dataTable">
            <!-- Data will be added here dynamically -->
        </tbody>
    </table>
    <script>
        $(document).ready(function () {
            function validateFields() {
                const name = $('#name').val().trim();
                const age = $('#age').val().trim();
                const gender = $('#gender').val();
                const mobile = $('#mobile').val().trim();
                const qualification = $('#qualification').val().trim();
                const address = $('#address').val().trim();

                if (name === '') {
                    alert('Name should not be empty.');
                    $('#name').focus();
                    return false;
                }

                if (age === '' || isNaN(age) || age <= 0 || age > 120) {
                    alert('Please enter a valid age between 1 and 120.');
                    $('#age').focus();
                    return false;
                }

                if (gender === '') {
                    alert('Please select a valid gender.');
                    $('#gender').focus();
                    return false;
                }

                const mobileRegex = /^[6-9]\d{9}$/; // Validates Indian mobile numbers
                if (mobile === '' || !mobileRegex.test(mobile)) {
                    alert('Please enter a valid mobile number (10 digits starting with 6-9).');
                    $('#mobile').focus();
                    return false;
                }

                if (qualification === '') {
                    alert('Qualification should not be empty.');
                    $('#qualification').focus();
                    return false;
                }

                if (address === '') {
                    alert('Address should not be empty.');
                    $('#address').focus();
                    return false;
                }

                return true;
            }

            // Add data
            $('#saveBtn').click(function () {
                if (!validateFields()) {
                    return; // Stop if validation fails
                }

                const name = $('#name').val().trim();
                const age = $('#age').val().trim();
                const gender = $('#gender').val();
                const mobile = $('#mobile').val().trim();
                const qualification = $('#qualification').val().trim();
                const address = $('#address').val().trim();

                const row = `
                    <tr>
                        <td>${name}</td>
                        <td>${age}</td>
                        <td>${gender}</td>
                        <td>${mobile}</td>
                        <td>${qualification}</td>
                        <td>${address}</td>
                        <td>
                            <button class="editBtn">Edit</button>
                            <button class="deleteBtn">Delete</button>
                        </td>
                    </tr>
                `;

                $('#dataTable').append(row);

                // Clear input fields
                $('#name').val('');
                $('#age').val('');
                $('#gender').val('');
                $('#mobile').val('');
                $('#qualification').val('');
                $('#address').val('');
            });

            // Delete data
            $(document).on('click', '.deleteBtn', function () {
                $(this).closest('tr').remove();
            });

            // Edit data
            $(document).on('click', '.editBtn', function () {
                const row = $(this).closest('tr');
                const name = row.find('td:eq(0)').text();
                const age = row.find('td:eq(1)').text();
                const gender = row.find('td:eq(2)').text();
                const mobile = row.find('td:eq(3)').text();
                const qualification = row.find('td:eq(4)').text();
                const address = row.find('td:eq(5)').text();

                $('#name').val(name);
                $('#age').val(age);
                $('#gender').val(gender);
                $('#mobile').val(mobile);
                $('#qualification').val(qualification);
                $('#address').val(address);

                row.remove(); // Remove row to update it after editing
            });
        });
    </script>

</body>
</html>