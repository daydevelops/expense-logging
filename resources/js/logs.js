window.delete = (id) => {

    axios.delete('/logs/' + id)
        .then(response => {
            location.reload()
        })
        .catch(errors => {
            console.log(errors);
        })
}