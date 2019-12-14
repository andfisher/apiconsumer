
const fetchContacts = () => {

    const contactsWrapper = document.getElementById('contacts');

    const appendContacts = (contacts) => {

        for (let i in contacts) {

            let div = document.createElement('div');
            div.className = 'contact';

            let avatar = contacts[i].avatar;
            let name = contacts[i].name;
            let bio = contacts[i].bio;
            let title = contacts[i].title;
            let company = contacts[i].company;
            let uuid = contacts[i].uuid;

            div.innerHTML = `
                <img src="${avatar}" alt="">
                <span class="name">${name}</span>
                <span class="title">${title}</span>
                <span class="company">${company}</span>
                <div class="bio">${bio}</div>
            `;

            const  fragment = document.createDocumentFragment();
            fragment.appendChild(div);

            contactsWrapper.appendChild(fragment);
        }
    };

    const appendErrors = (errors) => {

        const info = document.getElementById('info');

        let existing = document.querySelector('.errors', info);

        if (existing) existing.remove();

        const div = document.createElement('div');
        div.className = 'errors';

        let str = '';

        for (let i in errors) {
            str += errors[i] + '<br>';
        }

        div.innerHTML = str;

        const  fragment = document.createDocumentFragment();
        fragment.appendChild(div);

        info.prepend(fragment);
    };

    document.addEventListener('DOMContentLoaded', function() {

        let errors = [];

		fetch('/contacts', {
			method: 'GET',
			headers: {
				'Content-Type': 'application/json',
				'Access-Control-Origin': '*'
			}
		})
		.then((response) => {
			return response.json();
		})
		.then((data) => {

            document.getElementById('info').innerHTML = '';

            if (data.code !== undefined) {
                errors.push(data.message);
				throw new Error();
            }

            appendContacts(data);
		})
		.catch((data) => {
			appendErrors(errors);
		});

    });

};

fetchContacts();
