//
//  MapView.swift
//  lpz
//
//  Created by Jose Antonio Lopez Lopez on 22/6/23.
//

import SwiftUI
import MapKit

struct MapView: View {
    var coordinates: CLLocationCoordinate2D
    
    @State private var region = MKCoordinateRegion()
        
    
    private func _setRegion(_ coordinates: CLLocationCoordinate2D){
        region = MKCoordinateRegion(
            center: coordinates,
            span: MKCoordinateSpan(latitudeDelta: 0.2, longitudeDelta: 0.2)
        )
    }
    
    var body: some View {
        Map(coordinateRegion: $region)
        .onAppear(){
            _setRegion(coordinates)
        }
    }
}

struct MapView_Previews: PreviewProvider {
    static var previews: some View {
        MapView(coordinates: ModelData().landmarks[0].locationCoordinates)
    }
}
