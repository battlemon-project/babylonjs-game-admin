window.UIkit = require('uikit')
import Icons from 'uikit/dist/js/uikit-icons'

// loads the Icon plugin
UIkit.use(Icons);

const forms = document.getElementsByTagName('form')
for (let form of forms) {
    form.addEventListener('submit', () => {
        const buttons = form.getElementsByTagName('button')
        for (let button of buttons) {
            if (button.type === 'submit') {
                button.classList.add('uk-disabled')
                button.innerText = 'load...'
            }
        }
    })
}

const confirms = document.getElementsByClassName('confirm')

for (let confirmElement of confirms) {
    confirmElement.addEventListener('click', (e) => {
        if (!confirm('Are you sure?')) e.preventDefault()
    })
}
