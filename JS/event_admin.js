// Sample data to store announcements
let announcements = [];

// Function to add a new announcement
function addAnnouncement() {
  const title = document.getElementById("announcement-title").value;
  const des = document.getElementById("announcement-des").value;
  const date = document.getElementById("announcement-date").value;
  const category = document.getElementById("announcement-category").value;
  const llocation = document.getElementById("ann-location").value;
  const supervisor = document.getElementById("supervisor").value;
  const imageFile = document.getElementById("announcement-image").files[0];
  const eventID = document.getElementById('eventID').value;
  const count = document.getElementById('count').value;

  if (title && date && category) {
    // const newAnnouncement = {
    //   id: Date.now(), // Unique ID for each announcement
    //   title: title,
    //   des: des,
    //   date: date,
    //   llocation: llocation,
    //   supervisor: supervisor,
    //   category: category,
    //   image: image ? URL.createObjectURL(image) : null, // Store image URL
    // };
    // announcements.push(newAnnouncement);
    // renderAnnouncements();
    // clearForm();


    const form = new FormData();
    form.append('name',        title);
    form.append('description', des);
    form.append('date',        date);
    form.append('location',    llocation);
    form.append('supervisor',  supervisor);
    form.append('category_id', category);
    form.append('count',       count);
    if (imageFile) {
      form.append('image', imageFile);
  }

    fetch(eventID ? `./EditEvent.php?event_id=${eventID}` : `./AddNewEvent.php`, {
      method: 'POST',
      body: form
  })
  .then(res => res.json())
  .then(res => {

      if(!res.error) {

          renderAnnouncements();
          clearForm();
      } else {

          alert('Something went wrong')
      }


  }).catch(err => {
      console.error(err);

  })

  } else {
    alert("Please fill in all fields.");
  }
}

// Function to delete an announcement
function deleteAnnouncement(id) {
  fetch(`../Admin_Dashboard/DeleteEvent.php?event_id=${id}`)
  .then(res => res.json())
  .then(res => {

      if(!res.error) {
          renderAnnouncements();
      } else {
          alert('Something went wrong')
      }
  })
}

// Function to render all announcements
function renderAnnouncements() {
  const announcementList = document.getElementById("announcement-list");
  announcementList.innerHTML = "<h2>Existing Events</h2>";

  fetch(`../Admin_Dashboard/Get_Events.php`)
    .then((res) => res.json())
    .then((res) => {
      announcements = res;

      res.forEach((announcement) => {
        const announcementItem = document.createElement("div");
        announcementItem.className = "announcement-item";
        announcementItem.innerHTML = `
            <h3>${announcement.name} (${announcement.status})</h3>
            <p><strong style="text-decoration: underline;">Description:</strong> ${
              announcement.description
            }</p>
            <p><strong style="text-decoration: underline;">Date:</strong> ${
              announcement.date
            }</p>
            <p><strong style="text-decoration: underline;">Location:</strong> ${
              announcement.location
            }</p>
            <p><strong style="text-decoration: underline;">Supervisor:</strong> ${
              announcement.supervisor
            }</p>
            <p><strong style="text-decoration: underline;">Category:</strong> ${
              announcement.category
            }</p>
            ${
              announcement.image
                ? `<img src="${announcement.image}" alt="Announcement Image" />`
                : ""
            }
            <div class="actions">
                <button class="edit-btn" onclick="editAnnouncement(${
                  announcement.id
                })">Edit</button>
                <button class="delete-btn" onclick="deleteAnnouncement(${
                  announcement.id
                })">Delete</button>
            </div>
        `;
        announcementList.appendChild(announcementItem);
      });
    });
}

// Function to clear the form after adding an announcement
function clearForm() {
  document.getElementById("announcement-title").value = "";
  document.getElementById("announcement-date").value = "";
  document.getElementById("announcement-category").value = "";
  document.getElementById("announcement-image").value = "";
  document.getElementById("ann-location").value = "";
  document.getElementById("supervisor").value = "";
}

// Function to edit an announcement (placeholder for now)
function editAnnouncement(id) {
  const announcement = announcements.find(announcement => announcement.id == id);
  if (announcement) {
    
    document.getElementById('announcement-title').value = announcement.name;
    document.getElementById('announcement-date').value = announcement.date;
    document.getElementById('announcement-category').value = announcement.category_id;
    document.getElementById('announcement-des').value = announcement.description;
    document.getElementById('ann-location').value = announcement.location;
    document.getElementById('supervisor').value = announcement.supervisor;
    document.getElementById('count').value = announcement.count;
    document.getElementById('eventID').value = announcement.id;
  }
}

// Initial render of announcements
renderAnnouncements();
document.addEventListener("DOMContentLoaded", function () {
  // Theme Toggle
  const themeToggle = document.getElementById("themeToggle");
  themeToggle.addEventListener("click", function () {
    document.body.classList.toggle("dark-mode");

    // Update icon and text
    if (document.body.classList.contains("dark-mode")) {
      themeToggle.innerHTML =
        '<i class="fa-solid fa-sun"></i><span class="fs-14 ml-5">Light</span>';
    } else {
      themeToggle.innerHTML =
        '<i class="fa-solid fa-moon"></i><span class="fs-14 ml-5">Dark</span>';
    }
  });

  // Language Dropdown Toggle
  const languageToggle = document.getElementById("languageToggle");
  const languageDropdown = document.querySelector(".language-dropdown");

  languageToggle.addEventListener("click", function (e) {
    e.stopPropagation();
    languageDropdown.classList.toggle("hidden");
  });

  // Close dropdown when clicking elsewhere
  document.addEventListener("click", function () {
    languageDropdown.classList.add("hidden");
  });

  // Language selection
  document.querySelectorAll(".language-dropdown a").forEach((item) => {
    item.addEventListener("click", function (e) {
      e.preventDefault();
      const lang = this.getAttribute("data-lang");
      languageToggle.querySelector("span").textContent = lang.toUpperCase();
      // Here you would add your language change logic
      console.log("Language changed to:", lang);
      languageDropdown.classList.add("hidden");
    });
  });
});
// Add this to your existing JavaScript
document.getElementById("logoutBtn").addEventListener("click", function () {
  // Add your logout logic here
  console.log("Logout clicked");
  // Example: window.location.href = '/logout';

  // For demo purposes - show confirmation
  if (confirm("Are you sure you want to logout?")) {
    // Redirect to login page or perform logout action
    window.location.href = "login.html";
  }
});
