
    <style>
        .ul {
            color: #314528;
        }
        .notification{
            margin-right: 10px;
        }
        .notification-count {
            position: absolute;
            top: -6px;
            right: -6px;
            background-color: red;
            color: white;
            border-radius: 50%;
            font-size: 10px;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .notification-bar {
            position: absolute;
            top: 60px;
            right: 0;
            width: 350px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            display: none;
            z-index: 1000;
            font-family: 'Open Sans', sans-serif;
        }

        .notification-bar header {
            padding: 12px 16px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            font-size: 16px;
        }

        .notification-bar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            max-height: 300px;
            overflow-y: auto;
        }

        .notification-bar li {
            padding: 10px 16px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .notification-bar li:last-child {
            border-bottom: none;
        }

        .notification-bar .footer {
            padding: 10px 16px;
            text-align: center;
            background-color: #314528;
            border-top: 1px solid #eee;
        }

        .notification-bar .footer a {
            text-decoration: none;
            color: #f3f4e7;
            font-weight: 500;
        }
        @media (max-width: 460px){
            .notification-bar{
                right: -40px;
                width: 300px;
            }
        }
    </style>
    <div class="head bg-white p-15 between-flex">
                <div class="user-display p-relative d-flex align-center">
                    <i class="fa-solid fa-user-circle fa-lg c-main mr-10"></i>
                    <span class="fs-14 fw-500"><?php echo $name ?></span>
                </div>
                <div class="icons d-flex align-center">
                    <span class="notification p-relative">
                        <i class="fa-regular fa-bell fa-lg" id="notifBtn" style="cursor:pointer;"></i>
                        <span class="notification-count" id="notificationCount"></span>
                        <div class="notification-bar" id="notificationBar">
                            <header>
                                <span>Notifications</span>
                                <a href="#" style="font-size: 12px; color: #4a5d3d; text-decoration: underline;">Mark all read</a>
                            </header>
                            <ul>
                               
                            </ul>
                            <div class="footer">
                                <a href="#">View all notifications</a>
                            </div>
                        </div>
                    </span>
                    <i class="fa-solid fa-right-from-bracket ml-15"></i>
                </div>
            </div>

           <script>
document.addEventListener('DOMContentLoaded', () => {
  const notifBtn   = document.getElementById('notifBtn');
  const notifBar   = document.getElementById('notificationBar');
  const notifCount = document.getElementById('notificationCount');
  const listEl     = notifBar.querySelector('ul');
  /**
   * Turn an ISO timestamp into a “time ago” string.
   */
  function timeAgo(iso) {
    const deltaSec = Math.floor((Date.now() - new Date(iso)) / 1000);
    if (deltaSec < 60) return 'Just now';
    const m = Math.floor(deltaSec / 60);
    if (m < 60) return m + ' minute' + (m > 1 ? 's' : '') + ' ago';
    const h = Math.floor(m / 60);
    if (h < 24) return h + ' hour' + (h > 1 ? 's' : '') + ' ago';
    const d = Math.floor(h / 24);
    return d + ' day' + (d > 1 ? 's' : '') + ' ago';
  }

  /**
   * Fetch notifications from the API and render them.
   */
  async function fetchNotifications() {
    try {
      const res = await fetch('get_notifications.php');
      if (!res.ok) throw new Error(res.status);
      const items = await res.json();

      // 1) Update badge
      notifCount.textContent = items.length;
      notifCount.style.display = items.length ? 'flex' : 'none';

      // 2) Populate list
      listEl.innerHTML = '';  // clear old items
      if (items.length === 0) {
        listEl.innerHTML = '<li>No new notifications</li>';
        return;
      }

      items.forEach(item => {
        const li = document.createElement('li');

        if (item.type === 'announcement') {
          li.innerHTML = `
            <strong>${item.title}</strong><br>
            <small>${timeAgo(item.created)}</small>
          `;
        } else if (item.type === 'message') {
          li.innerHTML = `
            <a href="chat.php?room=${item.room_id}"><strong>New message from ${item.sender_name}</strong></a><br>
            <em>${item.body}</em><br>
            <small>${item.sender_name}, ${item.created}</small>
          `;
        }

        listEl.appendChild(li);
      });

    } catch (err) {
      console.error('Error loading notifications', err);
    }
  }

  // Toggle display and refresh on bell click
  notifBtn.addEventListener('click', e => {
    e.stopPropagation();
    // if opening, refresh
    if (notifBar.style.display !== 'block') {
      fetchNotifications();
    }
    notifBar.style.display = notifBar.style.display === 'block' ? 'none' : 'block';
  });

  // Close when clicking outside
  document.addEventListener('click', async e => {
    if (!notifBar.contains(e.target) && e.target !== notifBtn) {
      notifBar.style.display = 'none';
     
      try {
      const res = await fetch('update_last_seen.php');
       notifCount.style.display='none';
      }catch(e){
        console.log(e)
      }
    }
  });

  // Initial load (in case you want the count immediately)
  fetchNotifications();
});
</script>
