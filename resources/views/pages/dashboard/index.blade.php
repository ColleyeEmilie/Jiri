<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight  title">
            {{ __("Dashboard") }}
        </h2>
    </x-slot>
    <div class="py-12 font-sans">
        <div class="sm:px-6 lg:px-8 grid grid-cols-3 grid-rows-8 gap-4">
                <div class="col-span-2 row-span-2 bg-white relative content-position">
                    <div class="flex flex-col m-2">
                        <h3 class="mb-4 font-medium ">{{__("Informations générales")}}</h3>
                        <div class="flex justify-between mb-4 text-sm font-medium">
                            <div>
                                <p class=" text-gray-500 mb-2">{{__("Nom de l'épreuve")}}</p>
                                <p class=" text-gray-900 text-center">{{__("Design Web 2024")}}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 mb-2">{{__("Jurys présents ")}}</p>
                                <p class=" text-gray-900 text-center">{{__("4")}}</p>
                            </div>
                            <div >
                                <p class="text-gray-500 mb-2">{{__("Etudiants présents ")}}</p>
                                <p class=" text-gray-900 text-center">{{__("10")}}</p>
                            </div>
                        </div>
                        <div class="bg-orange-300">
                            <p class="text-white p-2 text-center">{{__("Terminer la session")}}</p>
                        </div>
                    </div>
                </div>
                <div class="row-span-4 col-start-3 bg-white relative content-position">
                    <div class="flex justify-between border-b border-gray-200 mb-4">
                        <h3 class="mb-4 font-medium">{{__("Jurys présents")}}</h3>
                        <p class="" >{{__("4")}}</p>
                    </div>
                    <div class="scrollbar-thin max-h-96 overflow-y-scroll scrollbar- scrollbar-thumb-orange-300 scrollbar-track-gray-100">
                        <div class="flex justify-between pr-4 mb-4">
                            <div class="flex">
                                <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                     class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm">
                                <div class="self-center ml-4">
                                    <p>Cyril Dubois</p>
                                    <p class="text-xs italic text-gray-400"> {{__("A déjà vu 5 étudiants")}}</p>
                                </div>
                            </div>
                            <p class="self-center">00:00</p>
                        </div>
                        <div class="flex justify-between pr-4 mb-4">
                            <div class="flex">
                                <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                     class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm">
                                <div class="self-center ml-4">
                                    <p>Cyril Dubois</p>
                                    <p class="text-xs italic text-gray-400"> {{__("A déjà vu 5 étudiants")}}</p>
                                </div>
                            </div>
                            <p class="self-center">00:00</p>
                        </div>
                        <div class="flex justify-between pr-4 mb-4">
                            <div class="flex">
                                <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                     class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm">
                                <div class="self-center ml-4">
                                    <p>Cyril Dubois</p>
                                    <p class="text-xs italic text-gray-400"> {{__("A déjà vu 5 étudiants")}}</p>
                                </div>
                            </div>
                            <p class="self-center">00:00</p>
                        </div>
                        <div class="flex justify-between pr-4 mb-4">
                            <div class="flex">
                                <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                     class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm">
                                <div class="self-center ml-4">
                                    <p>Cyril Dubois</p>
                                    <p class="text-xs italic text-gray-400"> {{__("A déjà vu 5 étudiants")}}</p>
                                </div>
                            </div>
                            <p class="self-center">00:00</p>
                        </div>

                    </div>
                </div>
                <div class="row-span-4 col-start-3 row-start-5 bg-white relative content-position">
                    <div class="flex justify-between border-b mb-4 border-gray-200">
                        <h3 class="mb-4 font-medium">{{__("Etudiants présents")}}</h3>
                        <p class="" >{{__("10")}}</p>
                    </div>
                    <div class="scrollbar-thin max-h-96 overflow-y-scroll scrollbar- scrollbar-thumb-orange-300 scrollbar-track-gray-100">
                        <div class="flex justify-between pr-4 mb-4">
                            <div class="flex">
                                <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                     class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm">
                                <div class="self-center ml-4">
                                    <p>Cyril Dubois</p>
                                    <p class="text-xs italic text-gray-400"> {{__("A déjà vu 3 jurys")}}</p>
                                </div>
                            </div>
                            <p class="self-center">00:00</p>
                        </div>
                        <div class="flex justify-between pr-4 mb-4">
                            <div class="flex">
                                <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                     class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm">
                                <div class="self-center ml-4">
                                    <p>Cyril Dubois</p>
                                    <p class="text-xs italic text-gray-400"> {{__("A déjà vu 3 jurys")}}</p>
                                </div>
                            </div>
                            <p class="self-center">00:00</p>
                        </div>
                        <div class="flex justify-between pr-4 mb-4">
                            <div class="flex">
                                <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                     class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm">
                                <div class="self-center ml-4">
                                    <p>Cyril Dubois</p>
                                    <p class="text-xs italic text-gray-400"> {{__("A déjà vu 3 jurys")}}</p>
                                </div>
                            </div>
                            <p class="self-center">00:00</p>
                        </div>
                        <div class="flex justify-between pr-4 mb-4">
                            <div class="flex">
                                <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                     class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm">
                                <div class="self-center ml-4">
                                    <p>Cyril Dubois</p>
                                    <p class="text-xs italic text-gray-400"> {{__("A déjà vu 3 jurys")}}</p>
                                </div>
                            </div>
                            <p class="self-center">00:00</p>
                        </div>
                        <div class="flex justify-between pr-4 mb-4">
                            <div class="flex">
                                <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                     class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm">
                                <div class="self-center ml-4">
                                    <p>Cyril Dubois</p>
                                    <p class="text-xs italic text-gray-400"> {{__("A déjà vu 3 jurys")}}</p>
                                </div>
                            </div>
                            <p class="self-center">00:00</p>
                        </div>
                        <div class="flex justify-between pr-4 mb-4">
                            <div class="flex">
                                <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                     class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm">
                                <div class="self-center ml-4">
                                    <p>Cyril Dubois</p>
                                    <p class="text-xs italic text-gray-400"> {{__("A déjà vu 3 jurys")}}</p>
                                </div>
                            </div>
                            <p class="self-center">00:00</p>
                        </div>
                        <div class="flex justify-between pr-4 mb-4">
                            <div class="flex">
                                <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                     class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm">
                                <div class="self-center ml-4">
                                    <p>Cyril Dubois</p>
                                    <p class="text-xs italic text-gray-400"> {{__("A déjà vu 3 jurys")}}</p>
                                </div>
                            </div>
                            <p class="self-center">00:00</p>
                        </div>
                        <div class="flex justify-between pr-4 mb-4">
                            <div class="flex">
                                <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                     class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm">
                                <div class="self-center ml-4">
                                    <p>Cyril Dubois</p>
                                    <p class="text-xs italic text-gray-400"> {{__("A déjà vu 3 jurys")}}</p>
                                </div>
                            </div>
                            <p class="self-center">00:00</p>
                        </div>
                        <div class="flex justify-between pr-4 mb-4">
                            <div class="flex">
                                <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                     class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm">
                                <div class="self-center ml-4">
                                    <p>Cyril Dubois</p>
                                    <p class="text-xs italic text-gray-400"> {{__("A déjà vu 3 jurys")}}</p>
                                </div>
                            </div>
                            <p class="self-center">00:00</p>
                        </div>
                        <div class="flex justify-between pr-4 mb-4">
                            <div class="flex">
                                <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                     class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm">
                                <div class="self-center ml-4">
                                    <p>Cyril Dubois</p>
                                    <p class="text-xs italic text-gray-400"> {{__("A déjà vu 3 jurys")}}</p>
                                </div>
                            </div>
                            <p class="self-center">00:00</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 row-span-2 col-start-1 row-start-3 bg-white relative content-position">
                    <h3 class="mb-4 font-medium">{{__("Moyenne actuelle des étudiants")}}</h3>
                    <div class="scrollbar-thin max-h-60 overflow-y-scroll scrollbar- scrollbar-thumb-orange-300 scrollbar-track-gray-100">
                    <table class="text-sm">
                        <tr class="h-16 font-light">
                            <th> </th>
                            <th class="w-24 text-gray-500 ">Portfolio</th>
                            <th class="w-24 text-gray-500 ">CV</th>
                            <th class="w-24 text-gray-500 ">Clinicoeurs</th>
                            <th class="w-24 text-gray-500 ">Générale</th>
                        </tr>
                        <tr class="h-16 border-b border-gray-200 text-gray-900 ">
                            <td class="flex h-16"><img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                     class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm"> <p class="self-center ml-4">Emilie Colleye</p></td>
                            <td class="text-center">13</td>
                            <td class="text-center">12</td>
                            <td class="text-center">11</td>
                            <td class="text-center">12</td>
                        </tr>
                        <tr class="h-16 border-b border-gray-200 text-gray-900 ">
                            <td class="flex h-16"> <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                      class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm"> <p class="self-center ml-4">Cyril Dubois</p></td>
                            <td class="text-center">13</td>
                            <td class="text-center">12</td>
                            <td class="text-center">11</td>
                            <td class="text-center">12</td>
                        </tr>
                        <tr class="h-16 border-b border-gray-200 text-gray-900 ">
                            <td class="flex h-16"> <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                      class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm"> <p class="self-center ml-4">Justin Wilson</p></td>
                            <td class="text-center">13</td>
                            <td class="text-center">12</td>
                            <td class="text-center">11</td>
                            <td class="text-center">12</td>
                        </tr>
                        <tr class="h-16 border-b border-gray-200 text-gray-900 ">
                            <td class="flex h-16"> <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                      class=" w-12 h-12 self-center rounded-full border border-gray-100 shadow-sm"> <p class="self-center ml-4">Sandra Benett</p></td>
                            <td class="text-center">13</td>
                            <td class="text-center">12</td>
                            <td class="text-center">11</td>
                            <td class="text-center">12</td>
                        </tr>
                        <tr class="h-16 border-b border-gray-200 text-gray-900 ">
                            <td class="flex h-16"> <img src="{{ asset('uploads/default.jpeg') }}" alt="avatar"
                                      class=" self-center w-12 h-12 rounded-full border border-gray-100 shadow-sm"> <p class="self-center ml-4">Emilie Colleye</p></td>
                            <td class="text-center">13</td>
                            <td class="text-center">12</td>
                            <td class="text-center">11</td>
                            <td class="text-center">12</td>
                        </tr>
                    </table>
                    </div>
                </div>
                <div class="col-span-2 col-start-1 row-start-5 bg-white relative content-position">
                    <h3 class="mb-4 font-medium">{{__("Tableau rencontre jurys et étudiants")}}</h3>
                </div>
                <div class="col-span-2 row-start-6 bg-white relative content-position">
                    <h3 class="mb-4 font-medium">{{__("Tableau général des cotes")}}</h3>
                </div>
                <div class="col-span-2 row-span-2 row-start-7 bg-white relative content-position ">
                    <h3 class="mb-4 font-medium">{{__("Projets présentés")}}</h3>
                    <div class="flex justify-between mb-4">
                        <div class="text-sm font-medium">
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500">{{__("Nom du projet")}}</p>
                                <p class="text-sm text-gray-900 text-center">{{__("Portfolio")}}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{__("Pondération")}}</p>
                                <p class=" text-sm text-gray-900 text-center">{{__("40%")}}</p>
                            </div>
                        </div>
                        <div>
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500">{{__("Nom du projet")}}</p>
                                <p class="text-sm text-gray-900 text-center">{{__("CV")}}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{__("Pondération")}}</p>
                                <p class="text-sm text-gray-900 text-center">{{__("20%")}}</p>
                            </div>
                        </div>
                        <div>
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-500">{{__("Nom du projet")}}</p>
                                <p class="text-sm text-gray-900 text-center">{{__("Clinicoeurs")}}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{__("Pondération")}}</p>
                                <p class="text-sm text-gray-900 text-center">{{__("40%")}}</p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</x-app-layout>
