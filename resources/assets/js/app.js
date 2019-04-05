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
        throw error
      })
    })
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
    this.generateColorsForLabels()
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

  generateColorsForLabels () {
    this.colors = Array.from(this.labels, _ => '#000000'.replace(/0/g, _ => (~~(Math.random() * 16)).toString(16)))
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
