#Millhouse Blog
Millhouse Blog is a simple php web application that includes a blog.It was ctreated as the basis for a project assigned by school, but everyone is welcome to use it.The implementation strives to be simple and free of unnecessary dependencies.

***
##Goals
*An easy way to create a simple, secure website with a blog
*Support for text-based and photo-based blog formats
*Ordering of posts by category
*Ability to author posts and a publish date
*Ability to create posts, edit post, delete post by _admin_
*Ability to comment on post, when logged in as _user_ or _admin_
*Safety to be taken into consideration ,using functions to prevent XSS attack
*No JavaScript requirement for client browsers.

***

##Structure
*/index.php             Entry point for the Blog application
*/views/register.php    To register as a _user_
*/views/login.php       To login as a user/admin
*/views/createPost.php  To create a new post as admin

##Instructions
1.Download and install XAMPP server.
2.Turn on Apache server and Mysql from Xampp control panel.
3.Fork and clone repository.
4.Open http://localhost/BloggCms/index.php to land in the home page.
5.There are two login role set ,
i)As admin, you get the previlage of creating a new post, editing a post and  deleting a post,commenting on post & deleting a comment.
ii)As user, you get to comment on the blog.
6.New registered user get the role of a user, hence can comment on the post.
7.The project comes with two users set with role _admin_ & _user_,
|Sr.no |Role |Username|Password|
|------|-----|--------|--------|
| 1    |admin|  admin | admin  |
| 2    |user |  user  | user   |


###Created By Jyoti

