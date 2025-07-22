 // when the page loads , fetch existing data
    window.onload = fetchData;

    // Handle form submission
    document.getElementById("userForm").addEventListener("submit", function (e) {
      e.preventDefault();
      // Get values from input 
      const name = document.getElementById("name").value;
      const age = document.getElementById("age").value;


      //Send the data to php to add new user 
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "actions.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        if (this.responseText === "success") {
          document.getElementById("userForm").reset();
          fetchData(); // Refresh data 
        }
      };
      xhr.send("action=add&name=" + name + "&age=" + age); // Send user data to server
    });
 //Toggle dark mode class on the <bode> element
    function toggleDarkMode() {
  document.body.classList.toggle("dark-mode");
}
 //Fetch and display user data from database
    function fetchData() {
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "actions.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        document.getElementById("dataBody").innerHTML = this.responseText;
      };
      xhr.send("action=fetch");
    }

    // Toggle user status between active and inactive
    function toggleStatus(id) {
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "actions.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        if (this.responseText === "success") {
          fetchData();
        }
      };
      xhr.send("action=toggle&id=" + id);
    }
    // Delete all users from the database
    function deleteAll() {
  if (confirm("Are you sure you want to delete ALL users?")) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "actions.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (this.responseText === "success") {
        fetchData();
      }
    };
    xhr.send("action=deleteAll");
  }


}