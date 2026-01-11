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
      });
        
    //     // User Management Actions
    //     document.querySelectorAll('.approve-user').forEach(button => {
    //         button.addEventListener('click', function() {
    //             const userId = this.getAttribute('data-user');
    //             const userRow = this.closest('tr');
                
    //             // Simulate API call
    //             setTimeout(() => {
    //                 userRow.classList.remove('bg-yellow-50');
    //                 userRow.classList.add('bg-green-50');
                    
    //                 // Update status
    //                 const statusCell = userRow.querySelector('td:nth-child(3)');
    //                 statusCell.innerHTML = '<span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Actif</span>';
                    
    //                 // Update actions
    //                 const actionsCell = userRow.querySelector('td:last-child');
    //                 actionsCell.innerHTML = `
    //                     <div class="flex space-x-2">
    //                         <button class="text-blue-600 hover:text-blue-900">
    //                             <i class="fas fa-eye"></i>
    //                         </button>
    //                         <button class="text-yellow-600 hover:text-yellow-900">
    //                             <i class="fas fa-edit"></i>
    //                         </button>
    //                         <button class="text-red-600 hover:text-red-900 suspend-user" data-user="${userId}">
    //                             <i class="fas fa-ban"></i>
    //                         </button>
    //                     </div>
    //                 `;
                    
    //                 // Re-attach event listeners
    //                 attachUserActionListeners();
                    
    //                 showNotification('Utilisateur approuvé', 'L\'utilisateur a été activé avec succès.');
    //             }, 300);
    //         });
    //     });
        
    //     document.querySelectorAll('.reject-user').forEach(button => {
    //         button.addEventListener('click', function() {
    //             const userId = this.getAttribute('data-user');
    //             const userRow = this.closest('tr');
                
    //             if (confirm('Êtes-vous sûr de vouloir rejeter cet utilisateur ?')) {
    //                 // Animation fade out
    //                 userRow.style.opacity = '0.5';
                    
    //                 setTimeout(() => {
    //                     userRow.remove();
    //                     showNotification('Utilisateur rejeté', 'La demande d\'inscription a été rejetée.');
    //                 }, 300);
    //             }
    //         });
    //     });
        
    //     document.querySelectorAll('.suspend-user').forEach(button => {
    //         button.addEventListener('click', function() {
    //             const userId = this.getAttribute('data-user');
    //             const userRow = this.closest('tr');
                
    //             if (confirm('Êtes-vous sûr de vouloir suspendre cet utilisateur ?')) {
    //                 // Update status
    //                 const statusCell = userRow.querySelector('td:nth-child(3)');
    //                 statusCell.innerHTML = '<span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Suspendu</span>';
                    
    //                 showNotification('Utilisateur suspendu', 'L\'utilisateur a été suspendu avec succès.');
    //             }
    //         });
    //     });
        
    //     document.querySelectorAll('.activate-user').forEach(button => {
    //         button.addEventListener('click', function() {
    //             const userId = this.getAttribute('data-user');
    //             const userRow = this.closest('tr');
                
    //             // Remove red background
    //             userRow.classList.remove('bg-red-50');
                
    //             // Update status
    //             const statusCell = userRow.querySelector('td:nth-child(3)');
    //             statusCell.innerHTML = '<span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Actif</span>';
                
    //             showNotification('Utilisateur activé', 'L\'utilisateur a été réactivé avec succès.');
    //         });
    //     });
        
    //     // Cancel Reservation Modal
    //     const cancelReservationModal = document.getElementById('cancel-reservation-modal');
    //     const cancelReservationButtons = document.querySelectorAll('.cancel-reservation-admin');
    //     const confirmCancelReservation = document.getElementById('confirm-cancel-reservation');
    //     const cancelCancelReservation = document.getElementById('cancel-cancel-reservation');
    //     const cancellationReason = document.getElementById('cancellation-reason');
    //     const otherReasonTextarea = document.getElementById('other-reason');
    //     const refundCheckbox = document.getElementById('refund-checkbox');
        
    //     // Reservation data (for demo)
    //     const reservationsData = {
    //         '2456': {
    //             id: '#RES-2456',
    //             property: 'Appartement Paris',
    //             traveler: 'Sophie Laurent',
    //             dates: '15-20 oct. 2023',
    //             amount: '267€',
    //             nights: 3
    //         },
    //         '2457': {
    //             id: '#RES-2457',
    //             property: 'Chalet Chamonix',
    //             traveler: 'Thomas Bernard',
    //             dates: '22-29 déc. 2023',
    //             amount: '1,015€',
    //             nights: 7
    //         }
    //     };
        
    //     cancelReservationButtons.forEach(button => {
    //         button.addEventListener('click', function() {
    //             currentReservationToCancel = this.getAttribute('data-id');
    //             const reservation = reservationsData[currentReservationToCancel];
                
    //             // Populate modal
    //             const detailsDiv = document.getElementById('reservation-details');
    //             detailsDiv.innerHTML = `
    //                 <div class="font-bold">${reservation.id}</div>
    //                 <div class="text-sm text-gray-600 mt-1">
    //                     <i class="fas fa-home mr-1"></i>${reservation.property}
    //                 </div>
    //                 <div class="text-sm text-gray-600 mt-1">
    //                     <i class="fas fa-user mr-1"></i>${reservation.traveler}
    //                 </div>
    //                 <div class="text-sm text-gray-600 mt-1">
    //                     <i class="far fa-calendar mr-1"></i>${reservation.dates} (${reservation.nights} nuits)
    //                 </div>
    //                 <div class="text-sm text-gray-600 mt-1">
    //                     <i class="fas fa-euro-sign mr-1"></i>Montant: ${reservation.amount}
    //                 </div>
    //             `;
                
    //             // Reset form
    //             cancellationReason.value = '';
    //             otherReasonTextarea.value = '';
    //             otherReasonTextarea.classList.add('hidden');
    //             refundCheckbox.checked = true;
                
    //             // Show modal
    //             cancelReservationModal.classList.remove('hidden');
    //         });
    //     });
        
    //     // Show/hide other reason textarea
    //     if(cancellationReason){
    //         cancellationReason.addEventListener('change', function() {
    //         if (this.value === 'other') {
    //             otherReasonTextarea.classList.remove('hidden');
    //             otherReasonTextarea.required = true;
    //         } else {
    //             otherReasonTextarea.classList.add('hidden');
    //             otherReasonTextarea.required = false;
    //         }
    //     });
    //     }

    // });
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

function dispalyBookingModal(title,price,rental_id,target){
    const bookingModal = document.getElementById("bookingModal");
    const newDiv = document.createElement('div');
    newDiv.innerHTML =`<!-- Overlay -->
  <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

    <!-- Modal -->
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">

      <!-- Header -->
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">
          Book This Rental
        </h2>
      </div>

      <!-- Rental Info -->
      <div class="mb-4 p-3 bg-gray-50 rounded-lg">
        <p class="text-sm font-medium text-gray-800">
          ${title}
        </p>
        <p class="text-sm text-gray-500">
          ${price} USD / night
        </p>
      </div>

      <!-- Form -->
      <form class="space-y-4 relative" method="post" action="../services/booking.php?rental_id=${rental_id}&target=${target}">

        <!-- Check-in -->
        <div>
          <label class="block text-sm font-medium text-gray-700">
            Check-in Date
          </label>
          <input
            type="date"
            id="checkin"
            name ="checkin"
            placeholder="Select check-in date"
            class="w-full mt-1 px-3 py-2 border rounded-lg bg-white cursor-pointer
                   focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
        </div>

        <!-- Check-out -->
        <div>
          <label class="block text-sm font-medium text-gray-700">
            Check-out Date
          </label>
          <input
            type="date"
            id="checkout"
            name ="checkout"
            placeholder="Select check-out date"
            class="w-full mt-1 px-3 py-2 border rounded-lg bg-white cursor-pointer
                   focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
        </div>
        <!-- Calendar -->
        <div
        id="calendar"
       class="hidden absolute z-50 mt-2 bg-white border rounded-xl shadow-lg p-4 w-72">
  <div class="flex justify-between items-center mb-3">
    <button id="prevMonth" class="px-2 text-gray-600 hover:text-black">&lt;</button>
    <h3 id="calendarTitle" class="font-semibold text-gray-800"></h3>
    <button id="nextMonth" class="px-2 text-gray-600 hover:text-black">&gt;</button>
  </div>

  <!-- Days -->
  <div class="grid grid-cols-7 text-center text-xs text-gray-500 mb-2">
    <span>Su</span><span>Mo</span><span>Tu</span>
    <span>We</span><span>Th</span><span>Fr</span><span>Sa</span>
  </div>

  <!-- Dates -->
  <div id="calendarDays" class="grid grid-cols-7 gap-1 text-center"></div>
</div>

        <!-- Price Summary -->
        <div class="border-t pt-3 text-sm text-gray-700">
          <div class="flex justify-between">
            <span>Total nights</span>
            <span id="total-nights">—</span>
          </div>
          <div class="flex justify-between font-semibold mt-1">
            <span>Total price</span>
            <span id="total-price">— USD</span>
          </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-end gap-3 pt-4">
          <button id="cancel"
            type="button"
            class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100"
          >
            Cancel
          </button>
          <button
            type="submit"
            class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700"
          >
            Confirm Booking
          </button>
        </div>

      </form>
    </div>
  </div>
`;
bookingModal.appendChild(newDiv);
const cancelBooking = document.getElementById("cancel");
cancelBooking.addEventListener("click",()=>{
    newDiv.remove();
})
}

function cancellationModal(bookingId,target){
    const modal = document.getElementById('cancellation-modal');
    const newDiv = document.createElement('div');
    newDiv.innerHTML = `    <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Confirmer l'annulation</h3>
                </div>
                
                <div class="mb-6">
                    <p class="text-gray-600 mb-4">Êtes-vous sûr de vouloir annuler cette réservation ?</p>
                </div>
                
                <div class="flex space-x-3">
                    <a href="../services/cancel-booking.php?booking-id=${bookingId}&target=${target}">
                        <button id="confirm-cancel" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-lg transition">
                        Oui, annuler
                        </button>
                    </a>
                    <button id="cancel-modal" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-6 rounded-lg transition">
                        Non, garder
                    </button>
                </div>
            </div>
        </div>
    </div>`;
    modal.appendChild(newDiv);
    document.getElementById("cancel-modal").addEventListener("click",()=>{
      newDiv.remove();
    })         
}

function changeUserStatut(id,stat,target){
  const popUpContainer = document.getElementById("pop-up-container");
  const newDiv = document.createElement('div');
  switch(stat){
    case 'active' :   newDiv.innerHTML = `<div class="inset-0 fixed bg-black/20 flex items-center justify-center">
                                          <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
                                          <div class="p-6">
                                          <div class="flex items-center justify-between mb-4">
                                          <h3 class="text-xl font-bold text-gray-800">Confimer la Suspension</h3>
                                          </div>
                
                                          <div class="mb-6">
                                          <p class="text-gray-600 mb-4">Êtes-vous sûr de vouloir suspender?</p>
                                          </div>
                
                                          <div class="flex space-x-3">
                                          <a href="../services/change-stat.php?id=${id}&action=deactivate&target=${target}">
                                          <button id="confirm-cancel" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-lg transition">
                                           Oui, Suspender
                                          </button>
                                          </a>
                                          <button id="cancel-change-stat" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-6 rounded-lg transition">
                                           Non
                                          </button>
                                          </div>
                                          </div>
                                          </div>
                                          </div>`;
                      break;
    case 'inactive' :   newDiv.innerHTML = `<div class="inset-0 fixed bg-black/20 flex items-center justify-center">
                                          <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
                                          <div class="p-6">
                                          <div class="flex items-center justify-between mb-4">
                                          <h3 class="text-xl font-bold text-gray-800">Confimer l'Activation</h3>
                                          </div>
                
                                          <div class="mb-6">
                                          <p class="text-gray-600 mb-4">Êtes-vous sûr de vouloir activer?</p>
                                          </div>
                
                                          <div class="flex space-x-3">
                                          <a href="../services/change-stat.php?id=${id}&action=activate&target=${target}">
                                          <button id="confirm-cancel" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-lg transition">
                                           Oui, Activer
                                          </button>
                                          </a>
                                          <button id="cancel-change-stat" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-6 rounded-lg transition">
                                           Non
                                          </button>
                                          </div>
                                          </div>
                                          </div>
                                          </div>`;
                       break;
  }
    popUpContainer.appendChild(newDiv);
    document.getElementById("cancel-change-stat").addEventListener("click",()=>{
      newDiv.remove();
    })
}