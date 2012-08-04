*This is in very early development. It's pretty broken right now*

cmsexp is a framework built with PHP and with MongoDB as the database. It's meant for rapidly developing
web applications while being able to scale out when needed. I started building it with some principals in
mind that I haven't seen done very well in any other framework or CMS.

*True Separation of Structure and Data*
Because of the nature of MongoDb, data(content) types can be made programatically. This means if the dababase
isn't found, it will be built from the application. No special database schema structure is needed to be initialized.

This makes for true separation of application structure and functionality from the data or state of the application.

*Modularity*
Once the system of the framework is built, it should be pretty much infinitely expandable based on modules. New data types can be defined as well as new pages and functionality of the application. Modules can be defined as dependent on another module if it needs its api or library.

*Object Oriented*
That's right. Real OOP with a modular framework.


# LICENSE #

Copyright 2012 Nathan Williford

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

   http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.