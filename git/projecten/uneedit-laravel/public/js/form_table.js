// Function to extract row data into an object
function getRowData(row) {
    const rowData = {};

    // Get all the cells in the row
    const cells = row.querySelectorAll('td');

    // Get the table headers
    const headers = row.closest('table').querySelectorAll('thead th');

    // Loop through the cells and map them to headers
    cells.forEach((cell, index) => {
        // Only consider the data cells (skip edit/delete buttons)
        if (index < headers.length - 2) { // Adjust based on your layout
            const header = headers[index].innerText;
            rowData[header] = cell.innerText; // Set the header as key and cell value as value
        }
    });

    return rowData; // Return the constructed object
}


document.addEventListener('DOMContentLoaded', function () {
    const createButtons = document.querySelectorAll('.create-button');

    createButtons.forEach(button => {
        button.addEventListener('click', function (event) { // Add 'event' parameter
            event.preventDefault(); // Call preventDefault on the event object
            console.log(this.formId); // If you're trying to log the formId attribute

            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Configure the request: method (POST) and URL
            xhr.open("POST", this.attributes.url.value, true); // Use POST instead of DELETE for creation

            // Set the request headers (including CSRF token for Laravel)
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content')); // Get the CSRF token

            // Handle response
            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    // Handle success (e.g., reload the page or update the UI)
                    console.log('Row created successfully:', xhr.responseText);
                    location.reload(); // Reload the page
                } else {
                    // Handle error
                    console.error('Error creating row:', xhr.statusText);
                }
            };

            // Send the request
            xhr.send();
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Get the parent row of the clicked button
            const row = this.closest('tr');

            // Create the data object to send with the DELETE request
            const updatedProductData = getRowData(row);

            // Extract the ID for the product
            const id = updatedProductData['id']; // Ensure your table has a header with 'id'

            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Define the URL of the resource you're deleting
            var url = this.attributes.url.value + '/' + id; // Replace with your actual endpoint

            // Configure the request: method (DELETE) and URL
            xhr.open("DELETE", url, true);

            // Set the request headers (including CSRF token for Laravel)
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content')); // Get the CSRF token

            // Handle response
            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    // Handle success (e.g., remove the row from the table)
                    console.log('Row deleted successfully:', xhr.responseText);
                    row.remove(); // Remove the row from the table
                } else {
                    // Handle error
                    console.error('Error deleting row:', xhr.statusText);
                }
            };

            // Send the request
            xhr.send();
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-button');

    editButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            const row = button.closest('tr');
            const cells = row.querySelectorAll('td');

            // Check if the button is in 'Edit' mode or 'Save' mode
            if (button.innerText === 'Edit') {
                // Switch to 'Save' mode
                button.innerText = 'Save';

                cells.forEach((cell, index) => {
                    if (index < cells.length - 2) { // Ignore last two cells (Edit and Delete)
                        // Get the computed width and height of the current cell
                        const cellWidth = window.getComputedStyle(cell).width;
                        const cellHeight = window.getComputedStyle(cell).height;

                        // Create a textarea element
                        const textarea = document.createElement('textarea');
                        textarea.value = cell.innerText; // Set textarea value to current cell value

                        // Set the textarea dimensions to match the cell dimensions
                        textarea.style.width = parseFloat(cellWidth) + 10;
                        textarea.style.height = parseFloat(cellHeight);

                        cell.innerHTML = ''; // Clear cell
                        cell.appendChild(textarea); // Append textarea to the cell
                    }
                });
            } else if (button.innerText === 'Save') {
                // Switch back to 'Edit' mode
                button.innerText = 'Edit';

                cells.forEach((cell, index) => {
                    if (index < cells.length - 2) { // Ignore last two cells (Edit and Delete)
                        const textarea = cell.querySelector('textarea');
                        if (textarea) {
                            cell.innerText = textarea.value; // Set the cell text to the textarea value
                        }
                    }
                });

                // Get updated row data using the getRowData function
                const rowData = getRowData(row);

                // Send XHR request to update the data
                const xhr = new XMLHttpRequest();
                xhr.open('POST', this.attributes.url.value, true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content')); // Get the CSRF token

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log('Row updated successfully!');
                    } else if (xhr.readyState === 4) {
                        console.error('Error updating row');
                    }
                };

                // Send the rowData as a JSON object
                xhr.send(JSON.stringify(rowData));
            }
        });
    });
});