export default class CanvasGrid {
  constructor (options) {
    this.options = Object.assign({}, {
      appendTo: document.body,
      width: 400,
      height: 400,
      cells: 100,
      gridColor: '#cecece'
    }, options)

    this.element = this.options.appendTo
    this.width = this.options.width
    this.height = this.options.height
    this.cells = this.options.cells

    this.step = this.width / this.cells

    this.gridColor = this.options.gridColor
    this.shapes = []
    this.init()
  }

  /**
   * create canvas element and insert it in the
   * element provided in the constructor
   * @returns {void}
   */
  init () {
    this.canvas = document.createElement('canvas')
    this.canvas.className = 'canvas-grid'
    this.canvas.width = this.options.width
    this.canvas.height = this.options.height
    this.element.appendChild(this.canvas)
    this.ctx = this.canvas.getContext('2d')
  }

  /**
   * creates the grid
   * @returns {void}
   */
  drawGrid () {
    this.drawHorizontalLines(this.gridColor)
    this.drawVerticalLines(this.gridColor)
  }

  /**
   * clear canvas
   * @returns {void}
   */
  resetStage () {
    this.ctx.clearRect(0, 0, this.width, this.height)
  }

  /**
   * set canvas stroke color
   * @returns {CanvasGrid}
   */
  strokeColor (color) {
    this.ctx.strokeStyle = color
    return this
  }

  /**
   * draw a line on the canvas
   * @param {Number} startX
   * @param {Number} startY
   * @param {Number} endX
   * @param {Number} endY
   * @returns {void}
   */
  drawLine (startX, startY, endX, endY) {
    this.ctx.beginPath()
    this.ctx.moveTo(startX, startY)
    this.ctx.lineTo(endX, endY)
    this.ctx.stroke()
  }

  /**
   * draw all the horizontal lines in the grid
   * @param {String} color
   */
  drawHorizontalLines (color) {
    this.strokeColor(color)
    for (let i = this.step; i < this.width; i = i + this.step) {
      this.drawLine(i, 0, i, this.height)
    }
  }

  /**
   * draw all the vertical lines in the grid
   * @param {String} color
   */
  drawVerticalLines (color) {
    this.strokeColor(color)
    for (let i = this.step; i < this.width; i = i + this.step) {
      this.drawLine(0, i, this.width, i)
    }
  }

  /**
   * creates a circle shape with fill color
   * @param {Number} cellX
   * @param {Number} cellY
   * @param {Number} radius
   * @param {String} color
   */
  drawCircle (cellX, cellY, radius, color) {
    let x = cellX * this.step
    let y = cellY * this.step
    let circle = new Path2D()
    circle.moveTo(x, y)
    circle.arc(x, y, radius, 0, 2 * Math.PI)
    this.shapes.push(circle)

    this.ctx.fillStyle = color
    this.ctx.fill(circle)
  }
}
