const openLoginModal = document.getElementById("loginBtn");
const openSignUpModal = document.getElementById("signupBtn");
const closeLoginModal = document.getElementById("close-login");
const closeSignUpModal = document.getElementById("close-register");
const loginModal = document.getElementById("loginModal");
const signupModal = document.getElementById("signupModal");
const signupRedirect = document.getElementById("signupRedirectBtn");
const loginRedirect = document.getElementById("loginRedirectBtn");
const openAddRentalsModal = document.getElementById("add-rental");
const closeAddRentalsModal = document.getElementById("close-add-rental-modal");
const addRentalModal = document.getElementById("add-rental-modal");
const changeStatut = document.querySelectorAll(".change-statut");

document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

                  const userMenuButton = document.querySelector('.group button');
            const userDropdown = document.querySelector('.group .hidden');
            
            if (userMenuButton && userDropdown) {
                userMenuButton.addEventListener('click', (e) => {
                    e.stopPropagation();
                    userDropdown.classList.toggle('hidden');
                });
                
                // Close dropdown when clicking elsewhere
                document.addEventListener('click', () => {
                    userDropdown.classList.add('hidden');
                });
            }

if(openLoginModal){
  openLoginModal.addEventListener("click",()=>{
    loginModal.classList.replace("hidden", "flex");
    loginModal.removeAttribute("aria-hidden");
  })
  closeLoginModal.addEventListener("click",()=>{
    loginModal.classList.replace("flex", "hidden");
    loginModal.setAttribute("aria-hidden","true");
  })
}
if(openSignUpModal){
  openSignUpModal.addEventListener("click",()=>{
    signupModal.classList.replace("hidden", "flex");
    signupModal.removeAttribute("aria-hidden");
  })
  closeSignUpModal.addEventListener("click",()=>{
    signupModal.classList.replace("flex", "hidden");
    signupModal.setAttribute("aria-hidden","true");
  })
}
if (signupRedirect) {
  signupRedirect.addEventListener("click", () => {
    loginModal.classList.replace("flex", "hidden");
    loginModal.setAttribute("aria-hidden", "true");
    signupModal.classList.replace("hidden", "flex");
    signupModal.removeAttribute("aria-hidden");
  })
}
if (loginRedirect) {
  loginRedirect.addEventListener("click", () => {
    signupModal.classList.replace("flex", "hidden");
    signupModal.setAttribute("aria-hidden", "true");
    loginModal.classList.replace("hidden", "flex");
    loginModal.removeAttribute("aria-hidden");
  })
}
if(openAddRentalsModal){
  openAddRentalsModal.addEventListener("click",()=>{
    addRentalModal.classList.replace("hidden", "flex");
    addRentalModal.removeAttribute("aria-hidden");
  })
  closeAddRentalsModal.addEventListener("click",()=>{
    addRentalModal.classList.replace("flex", "hidden");
    addRentalModal.setAttribute("aria-hidden","true");
  })
}
document.addEventListener("click", (e) => {
  if (e.target.classList.contains("overlay")) {
    currenttarget = e.target;
    currenttarget.classList.replace("flex", "hidden");
    currenttarget.setAttribute("aria-hidden", "true");
  }
})
 document.addEventListener('DOMContentLoaded', function() {
        // Variables
        let currentReservationToCancel = null;
        
        // Tab Switching
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabPanels = document.querySelectorAll('.tab-panel');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all tabs
                tabButtons.forEach(btn => {
                    btn.classList.remove('border-blue-600', 'text-blue-600');
                    btn.classList.add('border-transparent', 'text-gray-500');
                });
                
                // Add active class to clicked tab
                this.classList.add('border-blue-600', 'text-blue-600');
                this.classList.remove('border-transparent', 'text-gray-500');
                
                // Hide all tab panels
                tabPanels.forEach(panel => {
                    panel.classList.remove('active');
                    panel.classList.add('hidden');
                });
                
                // Show selected tab panel
                const tabId = this.id.replace('tab-', '') + '-content';
                const activePanel = document.getElementById(tabId);
                if (activePanel) {
                    activePanel.classList.remove('hidden');
                    activePanel.classList.add('active');
                }
            });
        });
        
        // User Management Actions
        document.querySelectorAll('.approve-user').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user');
                const userRow = this.closest('tr');
                
                // Simulate API call
                setTimeout(() => {
                    userRow.classList.remove('bg-yellow-50');
                    userRow.classList.add('bg-green-50');
                    
                    // Update status
                    const statusCell = userRow.querySelector('td:nth-child(3)');
                    statusCell.innerHTML = '<span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Actif</span>';
                    
                    // Update actions
                    const actionsCell = userRow.querySelector('td:last-child');
                    actionsCell.innerHTML = `
                        <div class="flex space-x-2">
                            <button class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="text-yellow-600 hover:text-yellow-900">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-900 suspend-user" data-user="${userId}">
                                <i class="fas fa-ban"></i>
                            </button>
                        </div>
                    `;
                    
                    // Re-attach event listeners
                    attachUserActionListeners();
                    
                    showNotification('Utilisateur approuvé', 'L\'utilisateur a été activé avec succès.');
                }, 300);
            });
        });
        
        document.querySelectorAll('.reject-user').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user');
                const userRow = this.closest('tr');
                
                if (confirm('Êtes-vous sûr de vouloir rejeter cet utilisateur ?')) {
                    // Animation fade out
                    userRow.style.opacity = '0.5';
                    
                    setTimeout(() => {
                        userRow.remove();
                        showNotification('Utilisateur rejeté', 'La demande d\'inscription a été rejetée.');
                    }, 300);
                }
            });
        });
        
        document.querySelectorAll('.suspend-user').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user');
                const userRow = this.closest('tr');
                
                if (confirm('Êtes-vous sûr de vouloir suspendre cet utilisateur ?')) {
                    // Update status
                    const statusCell = userRow.querySelector('td:nth-child(3)');
                    statusCell.innerHTML = '<span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Suspendu</span>';
                    
                    showNotification('Utilisateur suspendu', 'L\'utilisateur a été suspendu avec succès.');
                }
            });
        });
        
        document.querySelectorAll('.activate-user').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user');
                const userRow = this.closest('tr');
                
                // Remove red background
                userRow.classList.remove('bg-red-50');
                
                // Update status
                const statusCell = userRow.querySelector('td:nth-child(3)');
                statusCell.innerHTML = '<span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Actif</span>';
                
                showNotification('Utilisateur activé', 'L\'utilisateur a été réactivé avec succès.');
            });
        });
        
        // Cancel Reservation Modal
        const cancelReservationModal = document.getElementById('cancel-reservation-modal');
        const cancelReservationButtons = document.querySelectorAll('.cancel-reservation-admin');
        const confirmCancelReservation = document.getElementById('confirm-cancel-reservation');
        const cancelCancelReservation = document.getElementById('cancel-cancel-reservation');
        const cancellationReason = document.getElementById('cancellation-reason');
        const otherReasonTextarea = document.getElementById('other-reason');
        const refundCheckbox = document.getElementById('refund-checkbox');
        
        // Reservation data (for demo)
        const reservationsData = {
            '2456': {
                id: '#RES-2456',
                property: 'Appartement Paris',
                traveler: 'Sophie Laurent',
                dates: '15-20 oct. 2023',
                amount: '267€',
                nights: 3
            },
            '2457': {
                id: '#RES-2457',
                property: 'Chalet Chamonix',
                traveler: 'Thomas Bernard',
                dates: '22-29 déc. 2023',
                amount: '1,015€',
                nights: 7
            }
        };
        
        cancelReservationButtons.forEach(button => {
            button.addEventListener('click', function() {
                currentReservationToCancel = this.getAttribute('data-id');
                const reservation = reservationsData[currentReservationToCancel];
                
                // Populate modal
                const detailsDiv = document.getElementById('reservation-details');
                detailsDiv.innerHTML = `
                    <div class="font-bold">${reservation.id}</div>
                    <div class="text-sm text-gray-600 mt-1">
                        <i class="fas fa-home mr-1"></i>${reservation.property}
                    </div>
                    <div class="text-sm text-gray-600 mt-1">
                        <i class="fas fa-user mr-1"></i>${reservation.traveler}
                    </div>
                    <div class="text-sm text-gray-600 mt-1">
                        <i class="far fa-calendar mr-1"></i>${reservation.dates} (${reservation.nights} nuits)
                    </div>
                    <div class="text-sm text-gray-600 mt-1">
                        <i class="fas fa-euro-sign mr-1"></i>Montant: ${reservation.amount}
                    </div>
                `;
                
                // Reset form
                cancellationReason.value = '';
                otherReasonTextarea.value = '';
                otherReasonTextarea.classList.add('hidden');
                refundCheckbox.checked = true;
                
                // Show modal
                cancelReservationModal.classList.remove('hidden');
            });
        });
        
        // Show/hide other reason textarea
        if(cancellationReason){
            cancellationReason.addEventListener('change', function() {
            if (this.value === 'other') {
                otherReasonTextarea.classList.remove('hidden');
                otherReasonTextarea.required = true;
            } else {
                otherReasonTextarea.classList.add('hidden');
                otherReasonTextarea.required = false;
            }
        });
        }
        
        
        // Confirm cancellation
        if(confirmCancelReservation){
             confirmCancelReservation.addEventListener('click', function() {
            if (!cancellationReason.value) {
                alert('Veuillez sélectionner une raison');
                return;
            }
            
            if (cancellationReason.value === 'other' && !otherReasonTextarea.value.trim()) {
                alert('Veuillez expliquer la raison');
                return;
            }
            
            // Simulate cancellation
            setTimeout(() => {
                cancelReservationModal.classList.add('hidden');
                
                // Find and update the reservation row
                const reservationRow = document.querySelector(`[data-id="${currentReservationToCancel}"]`).closest('tr');
                const statusCell = reservationRow.querySelector('td:nth-child(6)');
                statusCell.innerHTML = '<span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Annulée</span>';
                
                // Remove cancel button
                const actionsCell = reservationRow.querySelector('td:last-child');
                actionsCell.innerHTML = `
                    <div class="flex space-x-2">
                        <button class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-eye"></i>
                        </button>
                        <span class="text-gray-400 text-sm">Annulée</span>
                    </div>
                `;
                
                showNotification('Réservation annulée', `La réservation ${currentReservationToCancel} a été annulée.`);
                currentReservationToCancel = null;
            }, 300);
        });
        }
       
        
    //     // Close cancellation modal
    //     cancelCancelReservation.addEventListener('click', function() {
    //         cancelReservationModal.classList.add('hidden');
    //         currentReservationToCancel = null;
    //     });
        
    //     // Close modal when clicking outside
    //     cancelReservationModal.addEventListener('click', function(e) {
    //         if (e.target === this) {
    //             cancelReservationModal.classList.add('hidden');
    //             currentReservationToCancel = null;
    //         }
    //     });
        
    //     // Notification System
    //     const notificationToast = document.getElementById('notification-toast');
    //     const closeNotification = document.getElementById('close-notification');
        
    //     function showNotification(title, message) {
    //         document.getElementById('notification-message').textContent = title;
    //         document.getElementById('notification-details').textContent = message;
            
    //         notificationToast.classList.remove('hidden');
    //         notificationToast.classList.add('slide-in');
            
    //         // Auto-hide after 5 seconds
    //         setTimeout(() => {
    //             notificationToast.classList.add('hidden');
    //         }, 5000);
    //     }
        
    //     closeNotification.addEventListener('click', function() {
    //         notificationToast.classList.add('hidden');
    //     });
        
    //     // Re-attach event listeners for dynamically added elements
    //     function attachUserActionListeners() {
    //         // Re-attach all user action listeners
    //         document.querySelectorAll('.approve-user, .reject-user, .suspend-user, .activate-user, .cancel-reservation-admin').forEach(button => {
    //             button.addEventListener('click', function() {
    //                 // The event listeners above will handle these
    //             });
    //         });
    //     }
        
    //     // Initialize
    //     attachUserActionListeners()

    //             // Handle escape key
    //     document.addEventListener('keydown', (e) => {
    //         if (e.key === 'Escape') {
    //             if (!cancelReservationModal.classList.contains('hidden')) {
    //                 cancelReservationModal.classList.add('hidden');
    //             }
    //             notificationToast.classList.add('hidden');
    //         }
    //     });
    });
    if(changeStatut){
        changeStatut.forEach(changeBtn=>{
            changeBtn.addEventListener("click",()=>{
                const id = changeBtn.getAttribute("data-id");
                if(changeBtn.classList.contains('active')){
                   const deactivateRental = document.getElementById("deactivateRentalModal");
                   deactivateRental.classList.replace('hidden','flex');
                   deactivateRental.removeAttribute('aria-hidden');
                   document.getElementById("deactivate-rental-id").value = id;
                }
                if(changeBtn.classList.contains('inactive')){
                    const activateRental = document.getElementById("activateRentalModal");
                    activateRental.classList.replace('hidden','flex');
                    activateRental.removeAttribute('aria-hidden');
                    document.getElementById("activate-rental-id").value = id;
                }
            })
        
        })
    }
    