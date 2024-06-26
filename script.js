const oud = document.getElementById("inp_oud")

const soort = document.getElementById("select_soort")
const perc = document.getElementById("inp_percentage")

const nieuw = document.getElementById("inp_nieuw")

const losopknop = document.getElementById("losop_btn")

const factor = document.getElementById("inp_factor")
const deler = document.getElementById("inp_deler")

const answer = document.getElementById("answer")

let ber_factor

function checkInput()
{
    if(oud.value != "" && soort.value != "" && perc.value != "")
    {
        losopknop.disabled = false
        oud.classList.remove("is-invalid")
        oud.classList.add("is-valid")
        soort.classList.remove("is-invalid")
        soort.classList.add("is-valid")
        perc.classList.remove("is-invalid")
        perc.classList.add("is-valid")
    }
    else if (nieuw.value != "" && soort.value != "" && perc.value != "")
    {
        losopknop.disabled = false
        nieuw.classList.remove("is-invalid")
        nieuw.classList.add("is-valid")
        soort.classList.remove("is-invalid")
        soort.classList.add("is-valid")
        perc.classList.remove("is-invalid")
        perc.classList.add("is-valid")
    }
    else if (oud.value != "" && nieuw.value != "")
    {
        losopknop.disabled = false
        oud.classList.remove("is-invalid")
        oud.classList.add("is-valid")
        nieuw.classList.remove("is-invalid")
        nieuw.classList.add("is-valid")
    }
}

function solveProblem()
{
    if(oud.value != "" && soort.value != "" && perc.value != "")
    {
        if(soort.value == 0)
            ber_factor = perc.value / 100
        else if(soort.value == 1)
            ber_factor = 1 + perc.value / 100
        else
            ber_factor = 1 - perc.value / 100
        factor.value = ber_factor
        deler.value = ber_factor
        nieuw.value = oud.value * ber_factor
    }
    else if (nieuw.value != "" && soort.value != "" && perc.value != "")
    {
        if(soort.value == 0)
            ber_factor = perc.value / 100
        else if(soort.value == 1)
            ber_factor = 1 + perc.value / 100
        else
            ber_factor = 1 - perc.value / 100
        factor.value = ber_factor
        deler.value = ber_factor
        oud.value = nieuw.value / ber_factor
    }
    else
    {
        ber_factor = (nieuw.value / oud.value).toFixed(4)
        factor.value = ber_factor
        deler.value = ber_factor
        if(ber_factor > 1)
        {
            soort.value = 1
            perc.value = ((ber_factor - 1) * 100).toFixed(2)
        }
        else
        {
            soort.value = 2
            perc.value = ((1 - ber_factor) * 100).toFixed(2)
        }
    }
    oud.disabled = true
    nieuw.disabled = true
    //alert ("je kunt opnieuw beginnen door een re-load")
    soort.disabled = true
    perc.disabled = true
    losopknop.disabled = true
}

function checkAnswer(antwoord){
    if(answer.value == antwoord){
        alert("Antwoord is goed")
    } else {
        alert("Antwoord is fout")
    }
}