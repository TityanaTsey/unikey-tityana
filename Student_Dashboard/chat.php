<?php
session_start();

$S_ID = $_SESSION['S_Log'] ?? null;
if (!$S_ID) {
    exit('Login required');
}
$user_id = $S_ID;
$user_nick = "Test"; // Replace with real user nickname
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Chat</title>
<style>
html,body{height:100%;margin:0;font-family:system-ui;background:#f4f4f4}
#shell{display:flex;height:100%}
#roomsPane{width:190px;background:#263238;color:#fff;display:flex;flex-direction:column}
#roomsPane h3{margin:0;padding:.9rem;border-bottom:1px solid #37474f}
#roomList{flex:1;overflow-y:auto}
.room{padding:.55rem .9rem;cursor:pointer}
.room.active{background:#546e7a}
#main{flex:1;display:flex;flex-direction:column;padding:1rem}
#chat{flex:1;border:1px solid #ccc;background:#fff;border-radius:.5rem;
      overflow-y:auto;padding:.8rem;display:flex;flex-direction:column;gap:.4rem}
.msg{max-width:70%;padding:.45rem .7rem;border-radius:.5rem;word-wrap:break-word;font-size:.9rem}
.me{margin-left:auto;background:#e3f2fd;text-align:right}
.other{margin-right:auto;background:#f1f8e9;text-align:left}
.time{display:block;color:#888;font-size:.75em;margin-top:.15rem}
.nick{font-weight:600;margin-right:.3em}
#sendForm{display:flex;gap:.6rem;margin-top:.6rem}
#msg{flex:1;padding:.5rem}
button{padding:.5rem .9rem;cursor:pointer}
</style>
</head>
<body>
<div id="shell">
  <aside id="roomsPane">
    <h3>My rooms</h3>
    <div id="roomList"></div>
  </aside>
  <section id="main">
    <div id="chat"></div>
    <form id="sendForm" autocomplete="off" style="display:none">
      <input id="msg" placeholder="Type a message…" required>
      <button>Send</button>
    </form>
  </section>
</div>

<script>
/* ---- globals ---- */
const currentUser = { id: <?=json_encode($user_id)?>, nick: <?=json_encode($user_nick)?> };
const urlParams = new URLSearchParams(window.location.search);
const currentRoomParam = urlParams.get('room');
let currentRoom = currentRoomParam ? parseInt(currentRoomParam) : '';
let lastId = 0;

/* ---- elements ---- */
const listDiv = document.getElementById('roomList');
const chatDiv = document.getElementById('chat');
const sendForm = document.getElementById('sendForm');
const msgInput = document.getElementById('msg');

/* ---- helpers ---- */
const sleep = ms => new Promise(r => setTimeout(r, ms));
function highlight() {
  document.querySelectorAll('.room').forEach(el => el.classList.toggle('active', el.dataset.roomId == currentRoom));
}

async function loadRooms() {
  try {
    const res = await fetch(`chat_api_rooms.php${currentRoom ? '?room=' + currentRoom : ''}`);
    if (!res.ok) throw new Error('Failed to load rooms');
    const rooms = await res.json();

    listDiv.innerHTML = '';

    if (rooms.length === 0) {
      listDiv.innerHTML = '<div style="padding:.5rem">— no rooms —</div>';
      return;
    }

    rooms.forEach(room => {
      const div = document.createElement('div');
      div.className = 'room' + (room.id == currentRoom ? ' active' : '');
      div.textContent = room.title;
      div.dataset.roomId = room.id;
      div.onclick = () => switchRoom(room.id, room.title);
      listDiv.appendChild(div);
    });

   if (currentRoom) {
  const found = rooms.find(r => r.id == currentRoom);
  if (found) {
    setTimeout(() => {
      // Temporarily reset to force switchRoom to run
      currentRoom = null;
      switchRoom(found.id, found.title);
      const el = document.querySelector(`.room[data-room-id="${found.id}"]`);
      if (el) el.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }, 0);
  } else {
    sendForm.style.display = 'none';
  }
}

  } catch (e) {
    listDiv.innerHTML = '<div style="padding:.5rem;color:red">Error loading rooms</div>';
    console.error(e);
  }
}


function switchRoom(roomId, roomTitle) {
  if (roomId === currentRoom) return;
  currentRoom = roomId;
  lastId = 0;
  chatDiv.innerHTML = '';
  sendForm.style.display = 'flex';
  msgInput.value = '';
  highlight();
  msgInput.focus();
}

/* ---- send message ---- */
sendForm.addEventListener('submit', async e => {
  e.preventDefault();
  const text = msgInput.value.trim();
  if (!text) return;
  try {
    const params = new URLSearchParams({ room: currentRoom, text });
    const res = await fetch('chat_api_send.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: params
    });
    if (!res.ok) throw new Error('Send failed');
    msgInput.value = '';
  } catch (err) {
    console.error('Error sending message:', err);
  }
});

/* ---- poll loop ---- */
(async function poll() {
  while (true) {
    if (!currentRoom) {
      await sleep(500);
      continue;
    }
    try {
      const r = await fetch(`chat_api_poll.php?room=${encodeURIComponent(currentRoom)}&since=${lastId}`, {
        cache: 'no-cache'
      });
      if (!r.ok) throw new Error('Poll failed');
      const data = await r.json();
      if (data.length) {
        data.forEach(renderMsg);
        lastId = Number(data[data.length - 1].id);
      }
    } catch (e) {
      console.error(e);
      await sleep(2000);
    }
  }
})();

/* ---- render message ---- */
function renderMsg(m) {
  const div = document.createElement('div');
  const mine = m.student_id === parseInt(currentUser.id);
  div.className = 'msg ' + (mine ? 'me' : 'other');
  const header = `<div class="nick">${mine ? 'You' : (m.full_name)}</div>`;
  div.innerHTML = header + m.body + `<span class="time">${new Date(m.created).toLocaleTimeString()}</span>`;
  chatDiv.appendChild(div);
  chatDiv.scrollTop = chatDiv.scrollHeight;
}

/* ---- bootstrap ---- */
loadRooms();
</script>

</body>
</html>
