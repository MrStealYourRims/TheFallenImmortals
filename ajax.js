// JavaScript Document
//////////////////
//AJAX Functions//
//////////////////

// Helper function to create an XMLHttpRequest object
function createXHR() {
    return new XMLHttpRequest();
}

// Function to evaluate AJAX response (GET method)
function evalAJAXHtml(source) {
    const xhr = createXHR();
    xhr.open("GET", source, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                try {
                    eval(xhr.responseText);
                } catch (e) {
                    console.error("Error evaluating AJAX response:", e);
                }
            } else {
                console.error("AJAX request failed. Status:", xhr.status);
            }
        }
    };
    xhr.send();
}

// Function to evaluate AJAX response (POST method)
function evalPostAJAXHtml(source, data) {
    const xhr = createXHR();
    xhr.open("POST", source, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                try {
                    eval(xhr.responseText);
                } catch (e) {
                    console.error("Error evaluating AJAX response:", e);
                }
            } else {
                console.error("AJAX request failed. Status:", xhr.status);
            }
        }
    };
    xhr.send(data);
}

// Example usage of the functions
// evalAJAXHtml('https://api.example.com/data');
// evalPostAJAXHtml('https://api.example.com/update', 'key1=value1&key2=value2');
