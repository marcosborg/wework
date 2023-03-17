const form = document.getElementById('submit_product');
    form.addEventListener("submit", function(event) {
    event.preventDefault();
  
    const company_id_input = document.getElementById("company_id");
    const funnel_id_input = document.getElementById("funnel_id");
    const first_name_input = document.getElementById("first_name");
    const last_name_input = document.getElementById("last_name");
    const phone_input = document.getElementById("phone");
    const email_input = document.getElementById("email");
    const district_input = document.getElementById("district");
    const file_input = document.getElementById("file");
   
    const company_id = company_id_input.value.trim();
    const funnel_id = funnel_id_input.value.trim();
    const first_name = first_name_input.value.trim();
    const last_name = last_name_input.value.trim();
    const phone = phone_input.value.trim();
    const email = email_input.value.trim();
    const district = district_input.value.trim();
    const file = file_input.files[0];
  
    const formData = new FormData();
    formData.append("company_id", company_id);
    formData.append("funnel_id", funnel_id);
    formData.append("first_name", first_name);
    formData.append("last_name", last_name);
    formData.append("phone", phone);
    formData.append("email", email);
    formData.append("district", district);
    formData.append("file", file);
  
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "https://we-work.pt/api/products/submit");
    xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) { // When the request is complete
        if (xhr.status === 200) { // If the response status is OK
            const response = JSON.parse(xhr.responseText); // Parse the response JSON
            alert('Enviado com sucesso.');
        } else if (xhr.status === 422) { // If the response status is "Unprocessable Entity"
            const errors = JSON.parse(xhr.responseText).errors; // Parse the error JSON
            alert('Os campos são todos obrigatórios.');
        } else { // If the response status is not OK or "Unprocessable Entity"
            const error = xhr.statusText; // Get the error message
            alert('Os campos são todos obrigatórios.');
        }
        console.log()
    }
};
    xhr.send(formData);
});