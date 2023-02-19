const toggleModalButtons = document.getElementsByClassName('toggle-bet-modal')
const modal = document.getElementById('bet-modal')
const betModalBackground = document.getElementsByClassName('bet-modal-background')[0]
const iconCloseBetModal = document.getElementsByClassName('icon-close-bet-modal')[0]

const closeModal = () => {
  modal.style.display = 'none'
  betModalBackground.style.display = 'none'
}

const openModal = () => {
  modal.style.display = 'block'
  betModalBackground.style.display = 'block'
}

closeModal()

for (const button of toggleModalButtons) {
  button.addEventListener('click', (e) => {
    openModal()
  })
}

iconCloseBetModal.addEventListener('click', closeModal)

document.addEventListener('click', (e) => {
  if (e.target === betModalBackground) {
    closeModal()
  }
})
