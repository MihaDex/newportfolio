(function () {
    const game = {
        win_code: [
            [1, 1, 1, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 1, 1, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 1, 1, 1],
            [1, 0, 0, 1, 0, 0, 1, 0, 0],
            [0, 1, 0, 0, 1, 0, 0, 1, 0],
            [0, 0, 1, 0, 0, 1, 0, 0, 1],
            [1, 0, 0, 0, 1, 0, 0, 0, 1],
            [0, 0, 1, 0, 1, 0, 1, 0, 0],
        ],
        x_gamer: [0, 0, 0, 0, 0, 0, 0, 0, 0],
        o_gamer: [0, 0, 0, 0, 0, 0, 0, 0, 0],
        x_gamer_turn: true,
        turn_count: 0,
        check_cell: function (pos) {
            if (this.x_gamer_turn && this.o_gamer[pos] === 1) {
                return false;
            }
            return !(!this.x_gamer_turn && this.x_gamer[pos] === 1);
        },
        reset: function () {
            for (let i = 0; i < 9; i++) {
                this.x_gamer[i] = 0;
                this.o_gamer[i] = 0;
                document.getElementById("pos" + i).innerText = "";
            }
            this.x_gamer_turn = true;
            this.turn_count = 0;
        },
        check_win: function () {
            let count_x = 0;
            let count_o = 0;
            if (this.x_gamer_turn) {
                for (let i = 0; i < 8; i++) {
                    count_x = 0;
                    for (let j = 0; j < 9; j++) {
                        if (this.win_code[i][j] === this.x_gamer[j] && this.x_gamer[j] === 1) {
                            count_x++;
                            if (count_x === 3) {
                                alert("игрок Х выйграл");
                                this.reset();
                            }
                        }
                    }
                }
            }
            if (!this.x_gamer_turn) {
                for (let i = 0; i < 8; i++) {
                    count_o = 0;
                    for (let j = 0; j < 9; j++) {
                        if (this.win_code[i][j] === this.o_gamer[j] && this.o_gamer[j] === 1) {
                            count_o++;
                            if (count_o === 3) {
                                alert("игрок O выйграл");
                                this.reset();
                            }
                        }
                    }
                }
            }
            this.turn_count++;
            if (this.turn_count === 9) {
                alert("Ничья!");
                this.reset();
            }
        },
        turn: function (pos) {
            if (this.x_gamer_turn && this.check_cell(pos)) {
                document.getElementById("pos" + pos).innerText = "x";
                this.x_gamer[pos] = 1;
                this.check_win();
                this.x_gamer_turn = false;
            }
            if (!this.x_gamer_turn && this.check_cell(pos)) {
                if (this.check_cell(pos)) {
                    document.getElementById("pos" + pos).innerText = "o";
                    this.o_gamer[pos] = 1;
                    this.check_win();
                    this.x_gamer_turn = true;
                }
            }
        },
        game_start: function () {
            let el;
            document.getElementById("reset").addEventListener("click", function () {
                game.reset();
            });
            for (let i = 0; i <= 8; i++) {
                el = document.getElementById("pos" + i);
                el.addEventListener("click", function () {
                    game.turn(i);
                });
            }
        }
    };

    const calc = {
        display_obj : null,
        display_val : null,
        operator : "",
        reset_calc : function() {
            calc.display_obj.innerHTML = "";
        },
        operations : function(){
            let val1 = calc.display_val.slice(0, calc.display_val.indexOf(calc.operator));
            let val2 = calc.display_val.slice(calc.display_val.indexOf(calc.operator)+1, calc.display_val.length-1);
            switch (calc.operator) {
                case "+":
                    calc.display_val = Number(val1)+Number(val2);
                    break;
                case "-":
                    calc.display_val = Number(val1)-Number(val2);
                    break;
                case "*":
                    calc.display_val = Number(val1)*Number(val2);
                    break;
                case "/":
                    calc.display_val = Number(val1)/Number(val2);
                    break;
                default:
                    break;
            }
        },
        click_item : function(e) {
            calc.display_obj.innerHTML += e.target.innerHTML;
            calc.display_val = calc.display_obj.innerHTML;
            switch(e.target.innerHTML){
                case "C" :
                    calc.reset_calc();
                    break;
                case "/" :
                    calc.operator = "/";
                    break;
                case "*" :
                    calc.operator = "*";
                    break;
                case "-" :
                    calc.operator = "-";
                    break;
                case "+" :
                    calc.operator = "+";
                    break;
                case "=" :
                    calc.operations();
                    calc.display_obj.innerHTML = calc.display_val;
                    break;
                default :
                    break;
            }
        },
        init_calc : function () {
            for(let i = 0; i<=15; i++) {
                let obj = document.getElementById('btn' + i);
                obj.addEventListener('click', this.click_item);
            }
            calc.display_obj = document.getElementById("display");
        },
    };

    window.onload = function () {
        game.game_start();
        calc.init_calc();

    };
})();