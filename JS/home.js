 // Confirmation dialog for event deletion
        document.querySelectorAll('.delete-event-btn').forEach(button => {
            button.addEventListener('click', function () {
                const eventName = this.getAttribute('data-event');
                const dialog = document.getElementById('confirmationDialog');
                const message = document.getElementById('confirmationMessage');

                message.textContent = `Are you sure you want to cancel your registration for "${eventName}"? This action cannot be undone.`;
                dialog.style.display = 'flex';

                document.getElementById('confirmDelete').onclick = function () {
                    // Here you would typically make an API call to delete the event
                    const card = button.closest('.item-card');
                    card.style.display = 'none';
                    dialog.style.display = 'none';
                    updateStats();
                };
            });
        });

        // Confirmation dialog for lost/found item deletion
        document.querySelectorAll('.delete-item-btn').forEach(button => {
            button.addEventListener('click', function () {
                const itemName = this.getAttribute('data-item');
                const dialog = document.getElementById('confirmationDialog');
                const message = document.getElementById('confirmationMessage');

                message.textContent = `Are you sure you want to delete the "${itemName}" item? This action cannot be undone.`;
                dialog.style.display = 'flex';

                document.getElementById('confirmDelete').onclick = function () {
                    // Here you would typically make an API call to delete the item
                    const card = button.closest('.item-card');
                    card.style.display = 'none';
                    dialog.style.display = 'none';
                    updateStats();
                };
            });
        });

        // Confirmation dialog for marketplace item deletion
        document.querySelectorAll('.delete-marketplace-btn').forEach(button => {
            button.addEventListener('click', function () {
                const itemName = this.getAttribute('data-item');
                const dialog = document.getElementById('confirmationDialog');
                const message = document.getElementById('confirmationMessage');

                message.textContent = `Are you sure you want to delete the "${itemName}" listing? This action cannot be undone.`;
                dialog.style.display = 'flex';

                document.getElementById('confirmDelete').onclick = function () {
                    // Here you would typically make an API call to delete the item
                    const card = button.closest('.item-card');
                    card.style.display = 'none';
                    dialog.style.display = 'none';
                    updateStats();
                };
            });
        });

        // Expire button functionality for found items
        document.querySelectorAll('.expire-btn').forEach(button => {
            button.addEventListener('click', function () {
                const card = this.closest('.item-card');
                const status = card.querySelector('.status');

                status.textContent = 'Expired';
                status.className = 'status status-expired';
                this.style.display = 'none';
            });
        });

        // Cancel button for confirmation dialog
        document.getElementById('cancelDelete').addEventListener('click', function () {
            document.getElementById('confirmationDialog').style.display = 'none';
        });

        // Update stats counters when items are deleted
        function updateStats() {
            const eventCount = document.querySelectorAll('.dashboard-section:nth-child(3) .item-card:not([style*="display: none"])').length;
            const lostCount = document.querySelectorAll('.dashboard-section:nth-child(4) .item-card:not([style*="display: none"])').length;
            const marketCount = document.querySelectorAll('.dashboard-section:nth-child(5) .item-card:not([style*="display: none"])').length;

            document.querySelectorAll('.user-stats .stat-box')[0].innerHTML = `<i class="fa-solid fa-calendar-check"></i> ${eventCount} Events`;
            document.querySelectorAll('.user-stats .stat-box')[1].innerHTML = `<i class="fa-solid fa-magnifying-glass"></i> ${lostCount} Lost Items`;
            document.querySelectorAll('.user-stats .stat-box')[2].innerHTML = `<i class="fa-solid fa-store"></i> ${marketCount} Marketplace`;
        }
            fetch('side.html')
        .then(response => {
        if (!response.ok) {
            throw new Error('Failed to load sidebar');
        }
        return response.text();
        })
        .then(html => {
        document.getElementById('sidebar-container').innerHTML = html;
        })
        .catch(error => {
        console.error('Error loading sidebar:', error);
        });
// Handle edit button clicks for all card types
document.querySelectorAll('.action-btn').forEach(button => {
    if (button.querySelector('.fa-pen-to-square')) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const card = this.closest('.item-card');
            if (!card) return;
            
            // Determine item type based on card content
            let itemType;
            const cardTitle = card.querySelector('h3, h4')?.textContent || '';
            
            if (cardTitle.includes('Found:')) {
                itemType = 'found';
            } else if (cardTitle.includes('Lost:')) {
                itemType = 'lost';
            } else if (cardTitle.includes('Saved Location')) {
                itemType = 'map';
            } else {
                // Marketplace items have h4 instead of h3
                itemType = 'marketplace';
            }
            
            // Get item data from the card
            const title = cardTitle.replace('Found:', '')
                                 .replace('Lost:', '')
                                 .trim();
            
            let description = '';


            
            if (itemType === 'marketplace') {
                // Marketplace description is in the second p tag
                description = card.querySelector('.marketplace-info p')?.textContent || '';
                const id = document.getElementById('marketID').textContent
               
                window.location.href = `../Student_Dashboard/Edit-Marketplace.php?marketplace_id=${id}`
                
            } else if(itemType === 'found')  {
                const id = document.getElementById('lostID').textContent
                    window.location.href = `../Student_Dashboard/Edit-Lost-Item.php?item_id=${id}`
            }
            
            else {
                // Other items use the first p tag
                description = card.querySelector('p')?.textContent || '';
            }
            
            // Redirect to edit page with parameters
            // window.location.href = `edit-item.php?type=${itemType}&title=${encodeURIComponent(title)}&description=${encodeURIComponent(description)}`;
        });
    }
});