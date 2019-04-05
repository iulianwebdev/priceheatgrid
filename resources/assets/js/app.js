import axios from 'axios'
import CanvasGrid from './shared/CanvasGrid'

export default class App {
  constructor () {
    this.data = []
    this.setup()
  }

  /**
   * start the app
   * boostrap every functionality
   */
  setup () {
    this.btn = document.getElementById('submit-data')
    this.dataField = document.getElementById('data-field')

    this.btn.addEventListener('click', e => {
      this.fetchData().then(([labels, data]) => {
        this.data = data.data
        this.labels = labels.data
        this.updateCanvas()
      }).catch(error => {
        this.handleError(error)
      })
    })
  }

  handleError (error) {
    if (error.response) {
      this.errorPopup = document.getElementById('popup')
      if (!this.errorPopup) {
        this.errorPopup = document.createElement('div')
        this.errorPopup.id = 'popup'
        this.errorPopupMessage = document.createElement('div')
        this.errorPopupClose = document.createElement('i')
        this.errorPopupClose.innerText = 'Close'
        this.errorPopupClose.id = 'closePopup'
        this.errorPopupClose.addEventListener('click', e => this.closePopup())
        this.errorPopup.appendChild(this.errorPopupClose)
        this.errorPopup.appendChild(this.errorPopupMessage)

        document.body.appendChild(this.errorPopup)
      }
      let message = error.response.data.data.join('<br>')

      this.errorPopupMessage.innerHTML = `<p>${message}</p>`
      this.errorPopup.classList.add('open')
      document.body.classList.add('blur')
    } else {
      throw error
    }
  }

  closePopup () {
    this.errorPopup.classList.remove('open')
    document.body.classList.remove('blur')
  }
  /**
   * get all data needed for the chart
   * @returns {Promise}
   */
  fetchData () {
    return Promise.all([
      axios.get('/data/labels'),
      axios.post('/data', { data: this.getSanitizedData() })
    ])
  }

  /**
   * extract an array of ints from the
   * unformatted string data
   * @returns {Array[]}
   */
  getSanitizedData () {
    let lines = this.dataField.value.split(/\n/)
    return lines.reduce((acc, val) => {
      acc.push(val.split(/\s+/).map(Number))
      return acc
    }, [])
  }

  /**
   * draw all the object related data on the canvas
   * @returns {void}
   */
  updateCanvas () {
    if (!this.canvas) {
      this.initCanvas()
    } else {
      this.canvas.resetStage()
    }

    this.canvas.drawGrid()

    if (this.shouldGenerateColors()) {
      this.generateColorsForLabels()
    }

    this.buildLegend()

    this.data.forEach(val => {
      this.canvas.drawCircle(val.x, val.y, 10, this.colors[val.level])
    })
  }

  /**
   * creates a new canvas object
   * @returns {void}
   */
  initCanvas () {
    this.canvas = new CanvasGrid({
      width: 800,
      height: 800,
      gridColor: '#ababab',
      appendTo: document.getElementById('canvas')
    })
  }

  /**
   * generate a random hex color value
   */
  generateColorsForLabels () {
    this.colors = Array.from(this.labels, _ => '#000000'.replace(/0/g, _ => (~~(Math.random() * 16)).toString(16)))
  }

  shouldGenerateColors () {
    if (!this.colors) {
      return true
    }
    return document.getElementById('save-colors').checked
  }

  /**
   * insert legend for canvas related information
   * @returns {void}
   */
  buildLegend () {
    this.legend = this.legend || document.createElement('ul')
    this.legend.className = 'legend'
    let childrenHtml = ''
    this.colors.forEach((el, idx) => {
      childrenHtml += `<li><i style="background-color:${el};"></i>${this.labels[idx]}</li>`
    })
    this.legend.innerHTML = childrenHtml
    this.canvas.element.parentNode.insertBefore(this.legend, this.canvas.element.nextSibling)
  }
}
