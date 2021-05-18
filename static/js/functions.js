let ajax = (url='/', dataSend=null) => {
        
    if (!dataSend) return;
    
    return new Promise((resolve, reject) => {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.onreadystatechange = function() { // Call a function when the state changes.
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                // Request finished. Do processing here.
                console.log(XMLHttpRequest.DONE); // pour des verif
                resolve(XMLHttpRequest.DONE);
            } else {
                if (this.readyState === XMLHttpRequest.DONE) {
                    reject('Une erreur c\'est produit');
                }
            }
        }

        xhr.send(dataSend);
    })
};