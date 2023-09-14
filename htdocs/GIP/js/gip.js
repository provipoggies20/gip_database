
const employmentSelect = document.getElementById("employment");
const sub_employmentSelect = document.getElementById("sub_employment");

employmentSelect.addEventListener("change", function() {
  const selectedEmployment = employmentSelect.value;

  sub_employmentSelect.innerHTML = "<option value=''>Select Sub-Employment Status</option>";

  if (selectedEmployment === "Employed") {
    sub_employmentSelect.innerHTML += "<option value='Wage Employed'>Wage Employed</option>";
    sub_employmentSelect.innerHTML += "<option value='Self-Employed'>Self-Employed</option>";

  } else if (selectedEmployment === "Unemployed") {
    sub_employmentSelect.innerHTML += "<option value='New Entrant/Fresh Graduate'>New Entrant/Fresh Graduate</option>";
    sub_employmentSelect.innerHTML += "<option value='Finished Contract'>Finished Contract</option>";
    sub_employmentSelect.innerHTML += "<option value='Resigned'>Resigned</option>";
    sub_employmentSelect.innerHTML += "<option value='Retired'>Retired</option>";
    sub_employmentSelect.innerHTML += "<option value='Terminated/Laid off due to calamity'>Terminated/Laid off due to calamity</option>";
    sub_employmentSelect.innerHTML += "<option value='Terminated/Laid off (Local)'>Terminated/Laid off (Local)</option>";
    sub_employmentSelect.innerHTML += "<option value='Terminated/Laid off (Abroad)'>Terminated/Laid off (Abroad)</option>";
    sub_employmentSelect.innerHTML += "<option value='Others'>Others</option>";
  }
});


 var timeout = null;

function sendRequest() {
    var search_term = document.getElementById("search_term").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("search_results").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "document-search.php?search_term=" + search_term, true);
    xhttp.send();
    
    // Save the search term in localStorage
    localStorage.setItem('searchTerm', search_term);
}

function handleKeyUp() {
    clearTimeout(timeout);
    timeout = setTimeout(function() {
        sendRequest();
    }, 500);
}

// Load the search term from localStorage on page load
var searchTerm = localStorage.getItem('searchTerm');
if (searchTerm) {
    document.getElementById('search_term').value = searchTerm;
}

document.getElementById("search_term").addEventListener("keyup", handleKeyUp);





    

