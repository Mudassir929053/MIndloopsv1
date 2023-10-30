class App {
  constructor(div) {
    this.div = div;
    this.canvas = document.getElementById("canvas");
    this.ctx = canvas.getContext("2d");
    this.dirty = true;
    this.prev = +new Date();

    this.resize();

    window.addEventListener("resize", () => this.resize(), false);

    this.canvas.addEventListener("mousedown", (event) => {
      this.touchdown(...App.getmousePos(event));
      event.preventDefault();
    });
    this.canvas.addEventListener("mousemove", (event) => {
      this.touchmove(...App.getmousePos(event));
      event.preventDefault();
    });
    this.canvas.addEventListener("mouseup", (event) => {
      this.touchup(...App.getmousePos(event));
      event.preventDefault();
    });
    this.canvas.addEventListener("touchstart", (event) => {
      this.touchdown(...App.getmousePos(event));
      event.preventDefault();
    });
    this.canvas.addEventListener("touchmove", (event) => {
      this.touchmove(App.getmousePos(event));
      event.preventDefault();
    });
    this.canvas.addEventListener("touchend", (event) => {
      this.touchup(App.getmousePos(event));
      event.preventDefault();
    });
  }

  resize() {
    this.canvas.width = this.div.clientWidth;
    this.canvas.height = this.div.clientWidth;
    this.draw();
  }

  loop() {
    let now = +new Date();
    let dt = now - this.prev;
    this.prev = now;
    this.update();
    if (this.dirty) this.draw();
    window.requestAnimationFrame(() => this.loop());
  }

  update(dt) {}

  draw() {
    this.ctx.clearRect(0, 0, canvas.width, canvas.height);
    this.ctx.rect(0, 0, 100, 100);
    this.ctx.fill();
  }

  touchdown(x, y) {
    console.log("down", x, y);
  }

  touchmove(x, y) {}

  touchup(x, y) {}

  static getmousePos(event) {
    if (event.changedTouches) {
      return [event.changedTouches[0].pageX, event.changedTouches[0].pageY];
    } else {
      var rect = event.target.getBoundingClientRect();
      return [event.clientX - rect.left, event.clientY - rect.top];
    }
  }
}

class Vector {
  constructor(x, y) {
    this.x = x;
    this.y = y;
  }

  add(v_x, y) {
    if (y != undefined) {
      return new Vector(this.x + v_x, this.y + y);
    } else {
      return new Vector(this.x + v_x.x, this.y + v_x.y);
    }
  }

  sub(v_x, y) {
    if (y != undefined) {
      return new Vector(this.x - v_x, this.y - y);
    } else {
      return new Vector(this.x - v_x.x, this.y - v_x.y);
    }
  }

  mul(s) {
    return new Vector(this.x * s, this.y * s);
  }

  get slength() {
    return this.x * this.x + this.y * this.y;
  }

  get length() {
    return Math.sqrt(this.x * this.x + this.y * this.y);
  }

  get angle() {
    return Math.atan2(this.y, this.x);
  }
}

class Puzzle {
  constructor(width, height, words, directions) {
    this.grid = new Grid(width, height);
    this.words = words;
    this.placeWords(words, directions);
  }

  placeWords(words, directions) {
    const range = (N) => Array.from({ length: N }, (v, k) => k);

    const shuffle = (array) => {
      for (let i = array.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
      }
      return array;
    };

    words = words.slice();
    let positions = range(this.grid.length);
    let stack = [
      {
        grid: this.grid,
        word: words.shift(),
        directions: shuffle(directions.slice()),
        positions: shuffle(positions.slice()),
      },
    ];

    while (true) {
      let current = stack[stack.length - 1];
      if (!current) throw Error("impossible");

      let dir = current.directions.pop();
      if (!dir) {
        current.positions.pop();
        current.directions = shuffle(directions.slice());
        dir = current.directions.pop();
      }

      if (current.positions.length <= 0) {
        words.unshift(current.word);
        stack.pop();
      } else {
        let pos = current.positions[current.positions.length - 1];

        let grid = this.placeWord(current.grid, current.word, pos, dir);

        if (grid) {
          if (words.length > 0) {
            stack.push({
              grid: grid,
              word: words.shift(),
              directions: shuffle(directions.slice()),
              positions: shuffle(positions.slice()),
            });
          } else {
            grid.finalize();
            this.grid = grid;
            break;
          }
        }
      }
    }
  }

  placeWord(grid, word, position, direction) {
    let copy = grid.clone();
    position = new Vector(
      position % grid.width,
      Math.floor(position / grid.width)
    );

    let letters = [...word];

    while (
      0 <= position.x &&
      position.x < grid.width &&
      0 <= position.y &&
      position.y < grid.height
    ) {
      if (letters.length <= 0) break;

      let letter = letters.shift();

      if (
        copy.get(position.x, position.y) == "_" ||
        copy.get(position.x, position.y) == letter
      ) {
        copy.set(letter, position.x, position.y);
        position = position.add(direction);
      } else {
        return null;
      }
    }

    if (letters.length > 0) return null;
    else return copy;
  }

  wordAt(position, direction, length) {
    let word = new Array(length);
    for (let i = 0; i < length; i++) {
      word[i] = this.grid.get(position.x, position.y);
      position = position.add(direction);
    }
    return word.join("");
  }

  print() {
    this.grid.print();
  }
}
class Selection {
  constructor(position, fill = false) {
    this.position = position;
    this._fill = fill;
    this.direction = new Vector(1, 0);
    this.length = 0;
    this.flength = 0;
  }

  clone() {
    return new Selection(this.position).to(
      this.position.add(this.direction.mul(this.length))
    );
  }

  to(position) {
    let direction = position.sub(this.position);
    if (Math.abs(direction.y) == 0) {
      this.direction = new Vector(direction.x >= 0 ? 1 : -1, 0);
      this.length = direction.x * this.direction.x;
    } else if (Math.abs(direction.x) == 0) {
      this.direction = new Vector(0, direction.y >= 0 ? 1 : -1);
      this.length = direction.y * this.direction.y;
    } else {
      this.direction = new Vector(
        direction.x >= 0 ? 1 : -1,
        direction.y >= 0 ? 1 : -1
      );
      this.length = direction.x * this.direction.x;
    }
    this.flength = direction.length;
    return this;
  }

  fill(fill = true) {
    this._fill = fill;
    return this;
  }

  draw(ctx, wsize, hsize) {
    let pos = this.position.mul(wsize);
    let length = wsize * (this.flength + 1);
    let angle = this.direction.angle;
    //console.log(this.x, this.y, x, y, length, angle, this.dx, this.dy);
    ctx.save();
    ctx.strokeStyle = "black";
    ctx.fillStyle = "pink";
    ctx.translate(pos.x + hsize * 0.5, pos.y + hsize * 0.5);
    ctx.rotate(angle);
    this.drawHighlight(
      ctx,
      -hsize * 0.5,
      -hsize * 0.5,
      length,
      hsize,
      hsize * 0.5,
      this._fill,
      true
    );
    ctx.restore();
  }

  drawHighlight(
    ctx,
    x,
    y,
    width,
    height,
    radius = 20,
    fill = true,
    stroke = false
  ) {
    ctx.beginPath();
    ctx.moveTo(x + radius, y);
    ctx.lineTo(x + width - radius, y);
    ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
    ctx.lineTo(x + width, y + height - radius);
    ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
    ctx.lineTo(x + radius, y + height);
    ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
    ctx.lineTo(x, y + radius);
    ctx.quadraticCurveTo(x, y, x + radius, y);
    ctx.closePath();
    if (fill) ctx.fill();
    if (stroke) ctx.stroke();
  }
}
