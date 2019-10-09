#include "Persona.h"
#include <iostream>
#include <string>

using namespace std;

void Persona::saludo() {
	cout << "Hola mariquita";
}

Persona::Persona() {
	cout << "Soy el constructor";
}

Persona::Persona(int i, string x) {
	Persona::i = i;
	Persona::x = x;
}