// Imports Pages to routes.
import HomePage			    from '../modules/Home/pages/IndexPage';
import RentPage			    from '../modules/Home/pages/RentPage';
import BooksPage			from '../modules/Home/pages/BooksPage';
import UsersPage		    from '../modules/User/pages/IndexPage';

const routes = [
	{
		path		: '',
		name		: 'home',
		component	: HomePage,
	},
	{
		path		: 'rents',
		name		: 'rents',
		component	: RentPage,
	},
	{
		path		: 'my-books',
		name		: 'mybooks',
		component	: BooksPage,
	},
	{
		path		: 'usuarios',
		name		: 'users',
		component	: UsersPage
	}

]
export default routes;
