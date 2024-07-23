//
//  ProfileSummary.swift
//  lpz
//
//  Created by Jose Antonio Lopez Lopez on 5/7/23.
//

import SwiftUI

struct ProfileSummary: View {
    var profile: Profile
    @EnvironmentObject var modelData: ModelData
    
    var body: some View {
        VStack (alignment: .leading, spacing: 10){
            Text(profile.username)
                .bold()
                .font(.title)
            Text("Notifications: \(profile.prefersNotifications ? "On" : "Off")")
            Text("Seasonal Photos: \(profile.seasonalPhoto.rawValue)")
            Text("Goal Date: ") +  Text(profile.goalDate, style: .date)
        
            Divider()
            
            VStack(alignment: .leading){
                Text("Completed Badge")
                    .font(.headline)
                
                ScrollView(.horizontal){
                    HStack {
                        HikeBadge(name: "First badge")
                        HikeBadge(name: "Second badge")
                            .hueRotation(Angle(degrees: 90))
                        HikeBadge(name: "Third badge")
                            .hueRotation(Angle(degrees: 45))
                            .grayscale(0.5)
                    }
                    .padding(.bottom)
                }
            }
            
            Divider()
            
            VStack(alignment: .leading) {
                Text("Recent hikes")
                    .font(.headline)
                
                HikeView(hike: modelData.hikes[0])
            }
        }
    }
}

struct ProfileSummary_Previews: PreviewProvider {
    static var previews: some View {
        ProfileSummary(profile: Profile.default)
            .environmentObject(ModelData())
    }
}
