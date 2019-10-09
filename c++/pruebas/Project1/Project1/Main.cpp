#include <iostream> // Libreria para input / output
#include <string>
#include <cmath>
#include <algorithm>
#include <array>
#include <fstream>
#include "Persona.h"
#include <new>

using namespace std;

/*int myFunction(int x, int y) {
	return x + y;
}*/

class Pepe {
	private:
		int edad;
		string nombre;

	public:
		Pepe(int x, string y) {
			edad = x;
			nombre = y;
		}

		Pepe() {}

		int medida() {
			cout << "le mide 35cm!";
			return 0;
		}

		int getEdad() {
			return edad;
		}

		string getNombre() {
			return nombre;
		}

		int ciatica(int y) {
			cout << "Soy el dios del sexo";
			return y;
		}
};

class Juan : public Pepe {
	public:
		Juan() {}

		Juan(int x, string y) : Pepe(x, y) {}

		void gilipollas() {
			cout << "soy gilipollas";
		}
};

int main() {

	//Persona p;

	//p.saludo();

	Persona * p = new Persona(1, "hola");

	p->saludo();

	cout << p->x;


	//Pepe pepe(56, "Pepe");
	
	/*pepe.edad = 12;
	pepe.nombre = "Juan";*/

	/*cout << pepe.getNombre() + " tiene " + to_string(pepe.getEdad()) + " anos" << endl;

	pepe.ciatica(5);

	pepe.medida();

	cout << "-----------" << endl;

	Juan juan(60, "juan");

	juan.gilipollas();

	cout << juan.getNombre();*/

	//cout << "Hello World!" << endl; 
	//cout << "Esta tiene un salto de linea \n a mitad";

	// endl designa un salto de linea (lo mismo que \n)

	//string pepe = "Pepe";
	//int edad = 15;

	//cout << pepe << " tiene " << edad << " anos" << endl;

	//cout << "Cuanto mide tu pepino?";

	//int x;

	//cin >> x;

	//cout << "Tu pepino mide: " << x;

	/*int f1 = 35e3;
	double d1 = 12E4;
	cout << f1 << "\n";
	cout << d1;*/

	/*string pepe = "Pepe ";

	int edad = 10;

	string cadena = pepe + to_string(to_string(edad).length()) + " hola pepe";

	cout << cadena;*/

	/*int x = 10;
	int y = 5;

	cout << max (x, y) << endl;

	double decimal = 7.999;

	cout << ceil(decimal) << endl;
	
	bool peter = (x > y);

	if (peter) {
		cout << "Its true";
	}
	else {
		cout << "Its false";
	}*/
	
	/*bool res = false;

	do {
		cout << "Seleccione una opcion" << endl;
		cout << "1 2 3 4 5" << endl;
		int x;
		cin >> x;

		switch (x)
		{
		case 1:
			cout << "has seleccionado 1" << endl;
			break;
		case 2:
			cout << "has seleccionado 2" << endl;
			break;
		case 3:
			cout << "has seleccionado 3" << endl;
			break;
		case 4:
			cout << "has seleccionado 4" << endl;
			break;
		case 5:
			cout << "has seleccionado 5" << endl;
			break;
		default:
			cout << "Adios";
			res = true;
			break;
		}
	} while (!res);*/

	//array<int, 5> pepe = { 1,2,3,4,5 };

	/*for (int i = 0; i < sizeof(pepe); i++)
	{	
		cout << pepe[i] << endl;

	}*/
	/*cout << "--------------" << endl;
	for (int i = 0; i < pepe.size(); i++)
	{
		cout << pepe[i] << endl;

	}*/

	/*
	string a = "pepe";
	cout << &a << endl;
	string* ptr = &a;
	
	cout << ptr << endl;

	string& b = a;

	cout << a << endl;

	b = "juan";

	cout << a << endl;
	*/
	
	// ofstream -> objeto para crear un fichero
	// ifstream -> objeto para leer un fichero
	// fstream -> objeto para crear, leer y escribir en un fichero

	// ofstream example
	
	/*ofstream MyFile("objeto.txt", ios::ate);
	MyFile << "Esto es lo que escribo pq me da la gana";

	MyFile.close();*/

	// ifstream example

	/*ifstream MyFileRead("objeto.txt");

	string pepe;

	string text;
	int a = 0;
	while (getline(MyFileRead, pepe)) {
		a++;
		cout << pepe;
		text += a + " guay";
	}

	MyFileRead.close();*/

	/*ofstream MyFile("objeto.txt",  ios::app);

	MyFile << "Soy pepe" << endl;
	MyFile << "Hola pepe" << endl;

	MyFile.close();
	*/
	// fstream example

	/*string pepe;
	fstream MyFileStream;

	MyFileStream.open("juan.txt", fstream::in | fstream::out | fstream::app);

	MyFileStream << "Vaya rabo que tengo aqui colgado"; --> me salen caracteres extra muy raros

	while (getline(MyFileStream, pepe))
	{
		cout << pepe;
	}

	MyFileStream.close();*/
	/*int sumo = myFunction(5,6);
	cout << sumo;*/
	return 0;
}