import { ref, computed } from 'vue';
import { defineStore } from 'pinia';

export const useProductStore = defineStore('product', {
    state: () => ({
        // Данные - которые я хочу получать с сервера
        products: localStorage.getItem('products') || [],
        // Дата последнего получения этих данных
        getAt: localStorage.getItem('products_getAt') || null,
    }),
    actions: {
        getProducts () {
            console.log(this.getAt)
            if (this.getAt === null) {
                fetch('https://65661cb2eb8bb4b70ef2eaa5.mockapi.io/products')
                    .then(res => res.json())
                    .then(data => {
                        this.products = data
                        this.getAt = Date.now()
                        console.log('Load from server')

                        localStorage.setItem('products', JSON.stringify(data))
                        localStorage.setItem('products_getAt', JSON.stringify(this.getAt))
                    })
                    .catch(err => {
                        console.log(err)
                    })
            }

            console.log(this.products)

        }
    }
});
