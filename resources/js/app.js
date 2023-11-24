import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

Alpine.data('contactsList', () => ({
    contactsList: false,
    usersList: [],
    splitString: function(){
        console.log('test');
    }
}))
