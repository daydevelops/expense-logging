window.delete = () => {

    axios.delete('/categories/' + window.cat2delete)
        .then(response => {
            location.reload()
        })
        .catch(errors => {
            console.log(errors);
        })
}

window.update = (id) => {
    var conts = document.querySelectorAll('.contribution-cat-' + id)
    var users = [];
    var percentages = [];
    for (var i = 0; i < conts.length; i++) {
        users.push(conts[i].dataset.user);
        percentages.push(conts[i].value)
    }
    axios.patch('/categories/' + id, {
            users: users,
            percentages: percentages
        })
        .then(response => {
            location.reload()
        })
        .catch(errors => {
            console.log(errors);
        })
}

window.new = () => {
    var name = $('#cat_name').val();
    var conts = document.querySelectorAll('.contribution')
    var users = [];
    var percentages = [];
    for (var i = 0; i < conts.length; i++) {
        users.push(conts[i].dataset.user);
        percentages.push(conts[i].value)
    }
    axios.post('/categories/', {
            name:name,
            users: users,
            percentages: percentages
        })
        .then(response => {
            window.location = "/categories"
        })
        .catch(errors => {
            console.log(errors);
        })
}