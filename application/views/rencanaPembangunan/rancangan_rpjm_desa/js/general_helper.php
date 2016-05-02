<script type="text/javascript">
    var ResetInputSelect = function (id) {

        $(id).find('option')
                .remove()
                .end();

    };

    var ValidateInput = function (elem, dvAlert, msg) {

        if ($("#" + elem + "").val() == '' || $("#" + elem + "").val() == null) {
            $("#" + elem + "").addClass('has-warning');

            $("#" + dvAlert + "").append(msg);
            return false;
        }
        return true;
    };

    var ResetValidationMessage = function () {
        $(".dvAlert").empty();
    };

    function toRp(a, b, c, d, e) {
        e = function (f) {
            return f.split('').reverse().join('')
        };
        b = e(parseInt(a, 10).toString());
        for (c = 0, d = ''; c < b.length; c++) {
            d += b[c];
            if ((c + 1) % 3 === 0 && c !== (b.length - 1)) {
                d += '.';
            }
        }
        return'Rp.\t' + e(d) + ',00'
    }

    function permute(input, permArr, usedChars) {
        var i, ch;
        for (i = 0; i < input.length; i++) {
            ch = input.splice(i, 1)[0];
            usedChars.push(ch);
            if (input.length == 0) {
                permArr.push(usedChars.slice());
            }
            permute(input, permArr, usedChars);
            input.splice(i, 0, ch);
            usedChars.pop();
        }
        return permArr;
    }

    function select2matcher(term, text) {

        if (term.length == 0)
            return true;
        texts = text.split(" ");

        allCombinations = permute(texts, [], []);

        for (i in allCombinations) {
            if (allCombinations[i].join(" ").toUpperCase().indexOf(term.toUpperCase()) == 0) {
                return true;
            }
        }

        return false;

    }

    function setCheck(id) {
        $("#" + id).attr("checked", "checked");
    }

    function remCheck(id) {
        $("#" + id).removeAttr("checked");
    }

</script>