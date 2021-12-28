// Imports Pages to routes.
import BooksPage	from '../views/books/pages/Books';
import MyBooksPage	from '../views/myBooks/pages/myBooks';
import UsersPage	from '../views/Users/pages/Users';

const routes = [
	{
		path		: '',
		name		: 'home',
		component	: BooksPage,
	},
	{
		path		: 'my-books',
		name		: 'mybooks',
		component	: MyBooksPage,
	},
	{
		path		: 'usuarios',
		name		: 'users',
		component	: UsersPage
	}

]
export default routes;
